<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $fillable = [
        'name',
        'image_path'
    ];

    public function department()
    {
        return $this->belongsTo(related: Department::class);
    }

    public function users()
    {
        return $this->hasMany(related: User::class)->with('user_images')->orderBy('frame', 'DESC')->orderBy('name', 'ASC')->orderBy('role', 'ASC')->orderBy('hired_at', 'ASC');
    }
}
