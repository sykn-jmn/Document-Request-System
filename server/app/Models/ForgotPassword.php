<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'code',
    ];

    protected $table = 'forgot_passwords';

    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
