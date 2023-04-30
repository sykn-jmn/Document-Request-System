<?php

namespace App\Modules;

use App\Models\Appointment;
use App\Models\Document;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RequestDocument{
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
        return response()->json($documents);
    }
}

