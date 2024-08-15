<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionImage extends Model
{
    use HasFactory;
    protected $table = 'suggestion_images';

    protected $fillable = [
        'suggestion_id',
        'image',
    ];

    public function suggestion()
    {
        return $this->belongsTo(Suggestion::class, 'suggestion_id');
    }
}
