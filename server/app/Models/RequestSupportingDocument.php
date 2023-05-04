<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSupportingDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'supporting_document_id',
        'type'
    ];

    protected $table = 'request_supporting_documents';
}
