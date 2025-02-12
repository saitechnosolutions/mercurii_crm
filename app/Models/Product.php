<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'productname',
        'hsn',
        'uom',
        'gst',
        'rate',
        'partno',
        'productdes',
        'Productcategory',
    ];


    public function category()
{
    return $this->belongsTo(Dropdowndata::class, 'Productcategory', 'id');
}

}
