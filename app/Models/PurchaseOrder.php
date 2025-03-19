<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = "purchase_order_tb";

    protected $fillable = [
        'cat_id',  
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
        'files',
        'terms_condition_id'
    ];

    public function categoryDetails(){
        return $this->belongsTo(ProductCategory::class, 'cat_id', 'id');
    }

    public function productDetails(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function vendorDetails(){
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function termsConditionDetails(){
        return $this->belongsTo(Term::class, 'terms_condition_id', 'id');
    }
}
