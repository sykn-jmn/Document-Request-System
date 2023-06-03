<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'birthplace' => $this->birthplace? $this->birthplace:'',
            'sex' => $this->sex,
            'civil_status' => $this->civil_status,
            'mobile_number' => $this->mobile_number,
            'religion' => $this->religion? $this->religion:'',
            'purok' => $this->purok? $this->purok:'',
            'barangay' => $this->barangay? $this->barangay: '',
            'municipality' => $this->municipality? $this->municipality: '',
            'province' => $this->province? $this->province: '',
            'zip_code' => $this->zip_code? $this->zip_code: '',
            'mothers_firstname' => $this->mothers_firstname,
            'mothers_middlename' => $this->mothers_middlename,
            'mothers_lastname' => $this->mothers_lastname,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
