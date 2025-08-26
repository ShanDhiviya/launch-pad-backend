<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Report;
use App\Models\Role;
use App\Models\Feature;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


      public function role()
    {
        return $this->belongsTo(Role::class);
    }


     public function isRole($role)
    {
        return $this->role->name === $role;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];

    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function features()
{
    return Feature::whereJsonContains('user_group', $this->role_id)->get();
}
}
