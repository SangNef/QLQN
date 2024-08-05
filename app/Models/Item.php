<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'item';

    protected $fillable = [
        'user_id',
        'date',
        'name',
        'type_1',
        'type_2',
        'type_3',
        'type_4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
