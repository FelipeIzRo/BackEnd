<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    function index()
    {
        return view('index');
    }
    
}