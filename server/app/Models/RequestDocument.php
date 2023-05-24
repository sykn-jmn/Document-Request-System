<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class RequestDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'document_id',
        'status'
    ];

    protected $table = 'request_documents';

    public function get_documents(){
        return $this->hasOne(Document::class, 'id', 'document_id')->select('name','description','fee');
    }
}
