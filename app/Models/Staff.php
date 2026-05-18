<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable=[
        'firstname',
        'middlename',
        'lastname',
        'gender',
        'dob',
        'designation_id',
        'nida',
        'nssf_refference',
        'tin_refference',
        'phone1',
        'phone2',
        'email_address',
        'residential_address',
        'permanent_address',
        'contact_person_name',
        'contact_person_mobile',
        'contact_person_address',
        'status'
    ];


    public function designation(){


        return $this->belongsTo(Designation::Class);
    }
}
