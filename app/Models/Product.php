<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'productname',
        'hsn',
        'uom',
        'gst',
        'rate',
        'partno',
        'productdes',
        'Productcategory',
        'quantity',
    ];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'Productcategory', 'id');
    }

    public function uomData()
    {
        return $this->belongsTo(UnitOfMeasurement::class, 'uom', 'id');
    }

}
