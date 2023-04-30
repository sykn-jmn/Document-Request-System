<?php

namespace App\Modules;

use App\Models\Appointment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RequestDocument{
    public function getSlots($payload){
        $startDate = $payload->startDate;
        $endDate = $payload->endDate;

        
        $getAppointments = Appointment::join('requests', 'requests.id', '=', 'appointments.request_id')
                    ->where('schedule','>=', $startDate)
                    ->where('schedule','<=', $endDate)
                    ->get();

        return response()->json([$getAppointments]);
    }
}

