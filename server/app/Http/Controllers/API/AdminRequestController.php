<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\AdminRequestDocument;


class AdminRequestController extends Controller
{
    public function index(AdminRequestDocument $requestDocument, $status, Request $request){
        return $requestDocument->getRequests($request, $status);
    }
    public function getSlots(Request $request, AdminRequestDocument $requestDocument){
        return $requestDocument->getSlots($request);
    }
    public function getDocuments(Request $request, AdminRequestDocument $requestDocument){
        return $requestDocument->getDocuments();
    }
    public function submitRequest(Request $request, AdminRequestDocument $requestDocument){
        return $requestDocument->submitRequest($request);
    }
    public function countRequest(Request $request, AdminRequestDocument $requestDocument){
        return $requestDocument->countRequest();
    }
    public function getRequestDetails(AdminRequestDocument $requestDocument, $id){
        return $requestDocument->getRequestDetails($id);
    }
    public function getPDF(AdminRequestDocument $requestDocument, $path){
        return $requestDocument->getPDF($path);
    }
    public function updateRequestStatus(AdminRequestDocument $requestDocument, Request $request){
        return $requestDocument->updateRequestStatus($request);
    }
    public function getReports(AdminRequestDocument $requestDocument){
        return $requestDocument->getReports();
    }
    public function getAllReports(AdminRequestDocument $requestDocument){
        return $requestDocument->getAllReports();
    }
}
