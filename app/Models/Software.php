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


    public function user_softwares()
    {
        return $this->hasMany(UserSoftware::class)->with('current_users');
    }
}
