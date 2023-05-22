<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ForgotPassword;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'profile_picture_id',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'sex',
        'position',
        'civil_status',
        'citizenship',
        'suffix',
        'mobile_number',
        'mothers_firstname',
        'mothers_middlename',
        'mothers_lastname',
        'email_code',
        'password',
    ];

}
