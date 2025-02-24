<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = ['id_lead', 'quota_id', 'id_customer', 'products', 'categorys', 'ga_number', 'quantitys'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($quotation) {
            $quotation->quota_id = 'QUTO/' . date('Y') . '/' . str_pad($quotation->id, 4, '0', STR_PAD_LEFT);
            $quotation->save();
        });
    }

   


}
