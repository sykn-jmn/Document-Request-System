<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\RequestDocument;

class RequestController extends Controller
{
    public function index(RequestDocument $requestDocument, $status, Request $request){
        return $requestDocument->getRequests($request, $status);
    }
    public function getSlots(Request $request, RequestDocument $requestDocument){
        return $requestDocument->getSlots($request);
    }
    public function getDocuments(Request $request, RequestDocument $requestDocument){
        return $requestDocument->getDocuments();
    }
    public function submitRequest(Request $request, RequestDocument $requestDocument){
        return $requestDocument->submitRequest($request);
    }
    public function countRequest(Request $request, RequestDocument $requestDocument){
        return $requestDocument->countRequest();
    }
    public function deleteRequest(RequestDocument $requestDocument, $id){
        return $requestDocument->deleteRequest($id);
    }
    public function updateSched(Request $request, RequestDocument $requestDocument){
        return $requestDocument->updateSched($request);
    }
    public function getRequest(RequestDocument $requestDocument, $id){
        return $requestDocument->getRequest($id);
    }
    public function getPDF(RequestDocument $requestDocument, $path){
        return $requestDocument->getPDF($path);
    }
    public function updateRequest(RequestDocument $requestDocument, Request $request){
        return $requestDocument->updateRequest($request);
    }
}
