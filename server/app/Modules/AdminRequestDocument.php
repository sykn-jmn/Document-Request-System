<?php

namespace App\Modules;

use App\Models\Appointment;
use App\Models\Document;
use App\Models\Reports;
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

class AdminRequestDocument{

    public function getRequests($payload, $status){
        $search = $payload->search;
        
        $requests = RequestDocumentModel::select(
            'request_documents.id',
            'appointments.schedule',
            'documents.name as document',
            'users.first_name',
            'users.last_name',
            'request_documents.status'
        )
        ->join('requests','requests.id','=','request_documents.request_id')
        ->join('appointments','appointments.request_id','=','requests.id')
        ->join('users','users.id','=','requests.user_id')
        ->join('documents','documents.id','=','request_documents.document_id')
        ->when($status!="all", function ($query) use($status){
            return $query->where('request_documents.status',$status);
        })
        ->when(!empty($search), function ($query) use($search){
            return $query->where('documents.name','LIKE', $search.'%');
        })
        ->paginate(7);
 
        return response()->json($requests);
        
    }

    public function getRequestDetails($id){
        $requestDetails = Request::select(
            'request_documents.id',
            'first_name',
            'middle_name',
            'last_name',
            'birthdate',
            'sex',
            'civil_status',
            'purok',
            'baranggay',
            'municipality',
            'province',
            'email',
            'mobile_number',
            'purpose',
            'schedule',
            'meridiem',
            'valid_ids.original_name as id_name',
            'valid_ids.path as id_path',
            'valid_ids.type as id_type',
            'documents.name as document_name'
        )
        ->join('request_documents','request_documents.request_id','=','requests.id')
        ->join('documents','documents.id','=','request_documents.document_id')
        ->join('valid_ids','valid_ids.id','=','requests.valid_id')
        ->join('users','users.id', '=', 'requests.user_id')
        ->join('appointments','appointments.request_id','=','requests.id')
        ->with('request_supporting_dcouments')
        ->where('request_documents.id',$id)->first();
        return response()->json($requestDetails);
    }

    public function getPDF($filename){
        return Storage::get('public/supporting_documents/'.$filename);
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

    public function updateRequestStatus($payload){
        $id = $payload->id;
        $status = $payload->status;
        $comments = $payload->comemnts;

        RequestDocumentModel::where('id', $id)->update([
            'status' => $status,
            'comments' => $comments
        ]);

        $charID = (string) $id;
        if(strlen($charID) < 6){
            $zerosToAdd = 6 - strlen($charID);
            $strId = '';

            for($i = 0; $i < $zerosToAdd; $i++){
                $strId .= '0'; 
            }
            $strId = $strId.$charID;
        }
        
        $admin = Auth::user();
        
        Reports::create([
            'message' =>'Request '.$strId.' (Baranggay Clearance) was approved by',
            'name' => $admin->first_name.' '.$admin->last_name,
            'status' => $status     
        ]);


        return response()->json(['message'=>'Request id '.$id. ' is '.$status]);
        

    }
    public function getReports(){
        $reports = Reports::select(
            'id',
            'message',
            'status',
            'name',
            'created_at as date'
        )->orderBy('created_at','desc')
        ->limit(10)
        ->get();
        return response()->json($reports);
    }

    public function getAllReports(){
        $allReports = Reports::select(
            'id',
            'message',
            'status',
            'name',
            'created_at as date'
        )
        ->orderBy('created_at','desc')
        ->paginate(10);

        return response()->json($allReports);
    }
}

