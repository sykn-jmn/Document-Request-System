<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidID extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'path'
    ];

    protected $table = 'valid_ids';
}
