<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads'; // Change if needed

    protected $guarded = [];


    public function assignedTo()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

public function leadstatus()
{
    return $this->belongsTo(Dropdowndata::class, 'Leadstatus');
}
public function assignedUser()
{
    return $this->belongsTo(User::class, 'assigned_to');
}


}


