<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadDesign extends Model
{
    use HasFactory;

    protected $table = 'leaddesigns';

    protected $fillable = [
        'leadiid',
        'catename',
        'proname',
        'design',
        'document',
        'assignee',
        'assigneeto',
        'reverse'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'leadiid');
    }
}
