<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class listourController extends Controller
{
    public function index()
    {
        return view('list.list_tour');
    }
}