<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionFile extends Model
{
    use HasFactory;
    protected $table = 'suggestion_files';

    protected $fillable = [
        'suggestion_id',
        'file',
    ];

    public function suggestion()
    {
        return $this->belongsTo(Suggestion::class, 'suggestion_id');
    }
}
