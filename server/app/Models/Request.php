<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RequestSupportingDocument;

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
    public function request_supporting_dcouments()
    {
        return $this->hasMany(RequestSupportingDocument::class, 'request_id', 'id')
                    ->join('supporting_documents', 'supporting_documents.id', '=', 'request_supporting_documents.supporting_document_id');
    }
}
