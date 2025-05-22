<?php

namespace App\Http\Controllers;


class WelcomeController extends Controller
{
    public function index()
    {
        // return 'Hello from the WelcomeController!';
        return view ('Welcome-again');
    }
}
