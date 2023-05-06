<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ForgotPassword;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'sex',
        'civil_status',
        'position',
        'mobile_number',
        'mothers_firstname',
        'mothers_middlename',
        'mothers_lasttname',
        'email_verified_at',
        'password'
    ];

}
