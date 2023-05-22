<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfilePicture extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'filename',
        'path',
    ];

    protected $table = 'admin_profile_pictures';
}
