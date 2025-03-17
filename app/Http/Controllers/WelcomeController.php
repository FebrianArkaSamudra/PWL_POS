<?php

namespace App\Http\Controllers; 

use Illuminate\Routing\Controller;

class WelcomeController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        return view('welcome', compact('breadcrumb', 'activeMenu'));
    }
}
