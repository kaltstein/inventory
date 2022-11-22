<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'FA_control_no',
        'stocks',
        'supplier',
        'contract_no',
        'expiry_date',
        'remarks',


    ];

    // public function current_user()
    // {
    //     return $this->belongsTo(User::class, 'user_id')->with('department')->with('team');
    // }


}
