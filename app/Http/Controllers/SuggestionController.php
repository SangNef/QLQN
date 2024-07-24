<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    //
    public function index()
    {
        $suggestions = Suggestion::all();
        return view('pages.suggestions.index', compact('suggestions'));
    }
}
