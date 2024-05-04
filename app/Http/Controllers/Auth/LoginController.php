<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login()
    {
        if (!Auth::check()) {
            return view('auth.pages.login');
        }

        return abort(404);
    }

    public function post_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            Alert::toast($validator->messages()->all(), 'error');
            return back();
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!Auth::attempt($data)) {
            Alert::toast('Email or Password is wrong', 'error');
            return redirect()->route('auth.login')->withInput();
        }

        return redirect()->route('master.product.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
