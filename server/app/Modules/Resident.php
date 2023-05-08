<?php

namespace App\Modules;


use App\Models\User;
use App\Models\Document;
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

class Resident{

    public function getResidents($filter){
        $getUsers = User::select(
            'first_name',
            'middle_name',
            'last_name',
            'sex',
            'email_verified_at',
            'mobile_number',
            'email',
            'purok',
            'baranggay',
            'municipality',
            'province'
        )->get();
        return response()->json($getUsers);
    }
}

