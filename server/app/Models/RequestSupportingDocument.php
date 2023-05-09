<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupportingDocument;
class RequestSupportingDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'supporting_document_id',
        'type'
    ];

    protected $table = 'request_supporting_documents';

    public function get_supporting_documents(){
        return $this->hasOne(SupportingDocument::class, 'id', 'supporting_document_id')->select('filename','path','type');
    }
}
