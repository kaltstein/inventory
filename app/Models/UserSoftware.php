<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSoftware extends Model
{
    protected $connection = 'mysql';
    use HasFactory;
    protected $table = 'user_softwares';

    protected $fillable = [
        'user_id',
        'software_id',

    ];


    public function software()
    {
        return $this->belongsTo(related: Software::class);
    }

    public function current_users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
