<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSupportingDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'support_document_id',
    ];

    protected $table = 'request_supporting_documents';
}
