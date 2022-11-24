<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'mysql2';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'team_id',
        'name',
        'role',
        'frame',
        'profile_path',
        'cover_path',
        'hired_at',
        'status',
        'email',
        'corporate_email',
        'password',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(related: Team::class);
    }
    public function department()
    {
        return $this->belongsTo(related: Department::class);
    }

    public function hardwares()
    {
        return $this->setConnection('mysql2')->hasMany(related: Hardware::class);
    }
    public function softwares()
    {

        return $this->hasMany(related: UserSoftware::class)->with('software');
    }
}
