<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAC extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'macs';
    use HasFactory;


    protected $fillable = [
        'user_id',
        'asset_no',
        'FA_control_no',
        'specs',
        'branch',
        'warranty_check',
        'warranty',
        'supplier',
        'system_sn',
        'status',
        'date_released',

    ];

    public function current_user()
    {
        return $this->belongsTo(User::class, 'user_id')->with('department')->with('team');
    }
}
