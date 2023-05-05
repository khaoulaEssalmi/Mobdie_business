<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public  function manager(){
        return view ('managerHome');
    }
    public  function analyst(){
        return view ('analystHome');
    }
}
