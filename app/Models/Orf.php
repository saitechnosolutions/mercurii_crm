<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orf extends Model
{
    use HasFactory;

    protected $table = 'orf';

    protected $fillable = [
        'tranref','quoproid' , 'leano', 'quono', 'custo', 'quotadate', 'orfref', 'orfdate',
        'cusporef', 'podate', 'attcuspo', 'approval_status', 'cs_status','sigdraw', 'crddate', 'specialins'
    ];
}
