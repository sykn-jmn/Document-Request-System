<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'valid_id',
        'date_requested',
        'purpose',
        'status',
        'fee',

    ];

    protected $table = 'requests';

    public function appointment(): HasOne
    {
        return $this->hasOne(Appointment::class, 'request_id', 'id');
    }
}
