<?php

namespace App\Modules;

use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Request{
    public function getSlots($payload){
        $year = $payload->year;
        $month = $payload->month;
        $date =  $payload->date;
        $meridiem = $payload->meridiem;


        $getDate = new Carbon($year, $month, $date, $meridiem);
    }
}

