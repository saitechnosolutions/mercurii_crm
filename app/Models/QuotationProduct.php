<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    use HasFactory;

    protected $table = 'quotationproduct';

    protected $fillable = [
        'quotationno', 'leadno', 'grandtotal', 'cliname', 'placeofsupply', 'gstnum',
        'catepro', 'product', 'part_no', 'quanty', 'allowdis',
        'requestdis', 'ratee', 'price', 'priceamt', 'lbt', 'tax', 'taxamt'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'leadno'); // Assuming `leadno` links to `leads.id`
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product', 'id');
    }

}
