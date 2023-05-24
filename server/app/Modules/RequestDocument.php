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
use Illuminate\Support\Facades\Storage;

class RequestDocument{

    public function getRequests($payload, $status){
        $search = $payload->search;
        $id = Auth::user()->id;
        $requests = Request::select(
            'requests.id',
            'requests.created_at as request_date',
            'documents.name as type',
            'requests.status',
            'requests.comment',
            'appointments.schedule as schedule'
        )
        ->join('documents','documents.id','=','requests.document_id')
        ->join('appointments','appointments.request_id','=','requests.id')
        ->when($status!="all", function ($query) use($status){
            return $query->where('requests.status',$status);
        })
        ->when(!empty($search), function ($query) use($search){
            return $query->where('documents.name','LIKE', $search.'%');
        })
        ->where('requests.user_id', $id)
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

        $document = json_decode($payload->selected_document);
        $selectedDate = $payload->pickup_date;
        $meridiem = $payload->meridiem;
        $validID = $payload->valid_id;
        $purpose = $payload->purpose;
        $fee = $payload->fee;
        $numberOfSupportingDocuments = $payload->supporting_documents_length;

        DB::beginTransaction();

        $validIDTransaction = $this->storeValidID($payload);

        $requestTransaction = Request::create([
            'user_id' => Auth::user()->id,
            'document_id' => $document->id,
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

 
            // $requestDocumentTransaction = $this->storeRequestDocument($requestTransaction->id, $document->id);
            // if(!$requestDocumentTransaction){
            //     DB::rollback();
            //     return response()->json(['message'=>'fail']);
            // }


        if(!$validIDTransaction || !$requestTransaction || !$appointmentTransaction){
            DB::rollback();
            return response()->json(['message'=>'fail']);
        }
        DB::commit();
        return response()->json(['message'=>'request saved succesfully']);
    }

    public function storeValidID($payload){
        $originalName = $payload->valid_id->getClientOriginalName();
        $file_name = time().'_'.$originalName;
        $extension = $payload->file('valid_id')->getClientOriginalExtension();
        $file_path = $payload->file('valid_id')->storeAs('valid_ids', $file_name, 'public');
        $extension = strtolower($extension);

        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif'){
            $file_type = 'image';
        }else if($extension == 'pdf'){
            $file_type = 'pdf';
        }else{
            $file_type = 'others';
        }

        return ValidID::create([
            'filename'=>$file_name,
            'original_name' => $originalName,
            'path'=>$file_path,
            'type'=>$file_type
        ]);
    }

    public function storeSupportingDocument($i, $payload){
        $originalName = $payload->supporting_document[$i]->getClientOriginalName();
        $file_name = time().'_'.$originalName;
        $extension = $payload->file('supporting_document')[$i]->getClientOriginalExtension();
        $file_path = $payload->file('supporting_document')[$i]->storeAs('supporting_documents', $file_name, 'public');
        $extension = strtolower($extension);

        if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif'){
            $file_type = 'image';
        }else if($extension == 'pdf'){
            $file_type = 'pdf';
        }else{
            $file_type = 'others';
        }

        return SupportingDocument::create([
            'filename'=>$file_name,
            'original_name' => $originalName,
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
    // public function storeRequestDocument($requestID, $documentID){


    //     return RequestDocumentModel::create([
    //         'request_id'=>$requestID,
    //         'document_id' => $documentID,
    //         'status'=>'pending'
    //     ]);
    // }
    public function storeAppointment($requestID, $selectedDate, $meridiem){
        return Appointment::create([
            'request_id' => $requestID,
            'schedule' => $selectedDate,
            'meridiem' => $meridiem,
        ]);
    }

    public function countRequest(){
        $id = Auth::user()->id;
        $countPending = Request::where('status','pending')
                                ->where('user_id',$id)
                                ->count();

        $countApproved = Request::where('status','approved')
                                ->where('user_id',$id)
                                ->count();
                            
        $countRejected= Request::where('status','rejected')
                                ->where('user_id',$id)
                                ->count();

        $countCompleted = Request::where('status','completed')
                                ->where('user_id',$id)
                                ->count();

        return response()->json([
            'pending' => $countPending,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'completed' => $countCompleted
        ]);
    }
    public function deleteRequest($id){
        Request::where('id',$id)->delete();
        return response()->json(['message'=>'deleted request successfully']);
    }
}

