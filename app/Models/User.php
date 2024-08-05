<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'department_id',
        'is_deleted',
    ];

    protected function suggestions()
    {
        return $this->hasMany(Suggestion::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    public function hospital()
    {
        return $this->hasMany(Hospital::class, 'user_id');
    }
}
