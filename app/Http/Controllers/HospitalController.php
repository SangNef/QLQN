<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    //
    public function index()
    {
        $hospitals = Hospital::all();
        return view('pages.hospitals.index', compact('hospitals'));
    }
}
