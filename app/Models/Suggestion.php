<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;
    protected $table = 'suggestions';

    protected $fillable = [
        'user_id',
        'date',
        'description',
        'status',    
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(SuggestionImage::class, 'suggestion_id');
    }

    public function files()
    {
        return $this->hasMany(SuggestionFile::class, 'suggestion_id');
    }
}
