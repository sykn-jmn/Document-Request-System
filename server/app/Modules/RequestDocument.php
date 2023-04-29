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
        $schedule = new Carbon($payload->schedule);
        $meridiem = $payload->meridiem;

        
        $count = Appointment::join('requests', 'requests.id', '=', 'appointments.request_id')
                    ->where('schedule', $schedule)
                    ->where('meridiem',$meridiem)
                    ->distinct()
                    ->count('requests.user_id');
        Log::info($schedule." ".$count);

        return response()->json(['slots'=>100-$count]);
    }
}

