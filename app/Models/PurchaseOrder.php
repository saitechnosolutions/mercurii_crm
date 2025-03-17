<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = "purchase_order_tb";

    protected $fillable = [
        'po_no',  
        'product_id',  
        'vendor_id',  
        'product_qty',  
        'unit_price',  
        'product_total_price',  
        'gst_amount',  
        'sub_total',  
        'total_amount',  
        'product_description',  
        'roundoff',  
    ];
}
