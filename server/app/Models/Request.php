<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'date_requested',
        'purpose',
        'supporting_doocuments_id',
        'status',
    ];

    protected $table = 'users';

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class, 'request_id', 'id');
    }
}
