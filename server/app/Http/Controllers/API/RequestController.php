<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\RequestDocument;

class RequestController extends Controller
{
    public function getSlots(Request $request, RequestDocument $requestDocument){
        return $requestDocument->getSlots($request);
    }
    public function getDocuments(Request $request, RequestDocument $requestDocument){
        return $requestDocument->getDocuments();
    }
}
