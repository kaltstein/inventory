<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $connection = 'mysql';
    use HasFactory;


    protected $fillable = [
        'user_id',
        'asset_no',
        'brand',
        'specs',
        'supplier',
        'serial_no',
        'service_tag',
        'FA_control_no',
        'date_released',

    ];

    public function current_user()
    {
        return $this->belongsTo(User::class, 'user_id')->with('department')->with('team');
    }
}
