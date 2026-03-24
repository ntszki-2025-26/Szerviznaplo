<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicelogController extends Controller
{
    public function index()
    {
        return view('servicelog.index');
    }
}
