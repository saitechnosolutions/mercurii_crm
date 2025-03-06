<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;
    protected $table = 'freight';

    protected $fillable = [
        'leadnumber',
        'quotationno',
        'termscondition',
        'dov',
        'freight',
        'exwork',
        'freightextra',
        'unloading',
        'remarks',
        'currency',
        'warranty',
        'installation',
        'agent',
        'amount',
    ];
}
