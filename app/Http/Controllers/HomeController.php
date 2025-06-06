<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;


class HomeController extends Controller
{
    public function dashboard()
    {
        dd('auth')->user()->getRoleNames();
        return view('home');
    }
}
