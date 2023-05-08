<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Resident;

class ResidentController extends Controller
{
    public function index(Resident $resident, $select){
        return $resident->getResidents($select);
    }
}
