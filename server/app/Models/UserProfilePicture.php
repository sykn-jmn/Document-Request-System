<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfilePicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'filename',
        'path',
    ];

    protected $table = 'user_profile_pictures';
}
