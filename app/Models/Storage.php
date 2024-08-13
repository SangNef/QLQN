<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $table = 'storages';

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
