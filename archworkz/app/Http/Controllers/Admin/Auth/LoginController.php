<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $logo       = @Setting::key(Setting::LOGO)->first()->value;       
        $icon       = @Setting::key(Setting::ICON)->first()->value;       
        $setting    = (object) compact('logo','icon');
        return view('admin.auth.login', compact('setting'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $remember = $request->remember;

        $admin = auth()->guard('web')->attempt($credentials, $remember);

        if($admin){
            return redirect()->intended(route('admin.index'));
        }

        return redirect()->back()->withInput($request->only('username','remember'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->back();
    }
}
