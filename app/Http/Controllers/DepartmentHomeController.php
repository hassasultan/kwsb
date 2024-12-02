<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartmentHomeController extends Controller
{
    //
    public function home()
    {
        return view('department.home');
    }
}
