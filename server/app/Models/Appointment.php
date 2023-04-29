<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'request_id',
        'schedule',
        'meridiem',
        'status',
        'admin_id',
    ];

    protected $table = 'appointmentss';
}
