<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Residents;

class ResidentController extends Controller
{
    public function index(Residents $residents, $filter){
        return $residents->getAllResidents($filter);
    }
}
