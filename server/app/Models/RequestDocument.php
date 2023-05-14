<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'request_number',
        'document_id',
        'status'
    ];

    protected $table = 'request_documents';
}
