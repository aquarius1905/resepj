<?php

namespace App\Http\Controllers;

class AdministratorController extends Controller
{
    public function index()
    {
        return view('/admin/dashboard');
    }
}
