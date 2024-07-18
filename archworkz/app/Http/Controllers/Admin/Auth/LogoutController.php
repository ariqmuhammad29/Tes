<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function index(){
        auth()->guard('web')->logout();
        return redirect()->route('admin.auth.login');
    }
}
