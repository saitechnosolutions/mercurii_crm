<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseEntry extends Model
{
    use HasFactory;

    protected $table = "purchase_entry_tb";

    protected $fillable = [
        "cat_id",
        "po_no",
        "product_id",
        "vendor_id",
        "requested_qty",
        "received_qty",
        "pending_qty",
        "unit_price",
        "product_total_price",
        "gst_amount",
        "sub_total",
        "total_amount",
    ];

    public function poDetails(){
        return $this->belongsTo(PurchaseOrder::class, 'po_no', 'po_no');
    }

    public function categoryDetails(){
        return $this->belongsTo(ProductCategory::class, 'cat_id', 'id');
    }

    public function productDetails(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function vendorDetails(){
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }
}
