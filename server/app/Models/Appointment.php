<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'schedule',
        'meridiem',
    ];

    protected $table = 'appointments';

    public function request(): HasOne
    {
        return $this->hasOne(Request::class, 'id', 'request_id');
    }
}
