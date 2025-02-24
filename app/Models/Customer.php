<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customername',
        'cusid',
        'contact_name',
        'cus_email',
        'country_code',
        'contact_no',
        'designation',
        'department',
        'address',
        'country',
        'city',
        'state',
        'postalcode',
        'gstno',
    ];
}
