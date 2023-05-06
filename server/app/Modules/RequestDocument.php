<?php

namespace App\Modules;

use App\Models\Appointment;
use App\Models\Document;
use App\Models\Request;
use App\Models\ValidID;
use App\Models\SupportingDocument;
use App\Models\RequestSupportingDocument;
use App\Models\RequestDocument as RequestDocumentModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RequestDocument{

    public function getRequests($payload, $status){
        $search = $payload->search;
        Log::info($search);
        
        $requests = RequestDocumentModel::select(
            'request_documents.id',
            'requests.created_at as request_date',
            'documents.name as type',
            'requests.status',
            'request_documents.updated_at as updated_date'
        )
        ->join('requests','requests.id','=','request_documents.request_id')
        ->join('documents','documents.id','=','request_documents.document_id')
        ->when($status!="all", function ($query) use($status){
            return $query->where('requests.status',$status);
        })
        ->when(!empty($search), function ($query) use($search){
            return $query->where('documents.name','LIKE', $search.'%');
        })
        ->paginate(7);
 
        return response()->json($requests);
        
    }

    public function getSlots($payload){
        $startDate = $payload->startDate;
        $endDate = $payload->endDate;

        
        $getAppointments = Appointment::select(
                    'user_id',
                    'appointments.schedule',
                    'appointments.meridiem',
                    )
                    ->join('requests', 'requests.id', '=', 'appointments.request_id')
                    ->where('schedule','>=', $startDate)
                    ->where('schedule','<=', $endDate)
                    ->distinct()
                    ->get();

        return response()->json($getAppointments);
    }

    public function getDocuments(){
        $documents = Document::get();
        return response()->json(json_decode($documents));
    }
    public function submitRequest($payload){

        $selectedDocuments = json_decode($payload->selected_documents);
        $numberOfSupportingDocuments = $payload->supporting_documents_length;
        $selectedDate = $payload->pickup_date;
        $meridiem = $payload->meridiem;
        $validID = $payload->valid_id;
        $purpose = $payload->purpose;
        $fee = $payload->fee;

        DB::beginTransaction();

        $validIDTransaction = $this->storeValidID($payload);

        $requestTransaction = Request::create([
            'user_id' => Auth::guard('users')->user()->id,
            'valid_id' =>$validIDTransaction->id,
            'date_requested' => now(),
            'purpose' => $purpose,
            'status' => 'pending',
            'fee' => $fee
        ]);

        $appointmentTransaction = $this->storeAppointment($requestTransaction->id, $selectedDate, $meridiem);

        if($numberOfSupportingDocuments && $numberOfSupportingDocuments>0){
            for($i = 0; $i < $numberOfSupportingDocuments; $i++){
                $supportingDocumentTransaction = $this->storeSupportingDocument($i, $payload);
                $requestSupportingDocumentTransaction = $this->storeRequestSupportingDocument($requestTransaction->id, $supportingDocumentTransaction->id);
    
                if(!$supportingDocumentTransaction || !$requestSupportingDocumentTransaction){
                    DB::rollback();
                    return response()->json(['message'=>'fail']);
                }
            }
        }

        foreach($selectedDocuments as $document){
            $requestDocumentTransaction = $this->storeRequestDocument($requestTransaction->id, $document->id);
            if(!$requestDocumentTransaction){
                DB::rollback();
                return response()->json(['message'=>'fail']);
            }
        }

        if(!$validIDTransaction || !$requestTransaction || !$appointmentTransaction){
            DB::rollback();
            return response()->json(['message'=>'fail']);
        }
        DB::commit();
        return response()->json(['message'=>'request saved succesfully']);
    }

    public function storeValidID($payload){
        $file_name = time().'_'.$payload->valid_id->getClientOriginalName();
        $file_path = $payload->file('valid_id')->storeAs('valid_ids', $file_name, 'public');

        return ValidID::create([
            'filename'=>$file_name,
            'path'=>$file_path
        ]);
    }

    public function storeSupportingDocument($i, $payload){
        $file_name = time().'_'.$payload->supporting_document[$i]->getClientOriginalName();
        $extension = $payload->file('supporting_document')[$i]->getClientOriginalExtension();
        $file_path = $payload->file('supporting_document')[$i]->storeAs('supporting_documents', $file_name, 'public');

        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension = 'gif'){
            $file_type = 'image';
        }else if($extension == 'pdf'){
            $file_type = 'pdf';
        }else{
            $file_type = 'others';
        }

        return SupportingDocument::create([
            'filename'=>$file_name,
            'path'=>$file_path,
            'type'=>$file_type
        ]);
    }

    public function storeRequestSupportingDocument($requestID, $supportDocumentID){
        return RequestSupportingDocument::create([
            'request_id'=>$requestID,
            'supporting_document_id' => $supportDocumentID
        ]);
    }
    public function storeRequestDocument($requestID, $documentID){
        return RequestDocumentModel::create([
            'request_id'=>$requestID,
            'document_id' => $documentID,
            'status'=>'pending'
        ]);
    }
    public function storeAppointment($requestID, $selectedDate, $meridiem){
        return Appointment::create([
            'request_id' => $requestID,
            'schedule' => $selectedDate,
            'meridiem' => $meridiem,
        ]);
    }

    public function countRequest(){
        $countPending = RequestDocumentModel::join('requests','requests.id', '=', 'request_documents.request_id')
                                        ->where('request_documents.status','pending')
                                        ->count();

        $countApproved = RequestDocumentModel::join('requests','requests.id', '=', 'request_documents.request_id')
                                        ->where('request_documents.status','approved')
                                        ->count();
                            
        $countRejected= RequestDocumentModel::join('requests','requests.id', '=', 'request_documents.request_id')
                                        ->where('request_documents.status','rejected')
                                        ->count();

        $countCompleted = RequestDocumentModel::join('requests','requests.id', '=', 'request_documents.request_id')
                                        ->where('request_documents.status','completed')
                                        ->count();

        return response()->json([
            'pending' => $countPending,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'completed' => $countCompleted
        ]);
    }
}

