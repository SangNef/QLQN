<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $table = 'hospitals';

    protected $fillable = [
        'user_id',
        'name',
        'year_birth',
        'gender',
        'room_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
