<?php

namespace App\Http\Controllers\Inside;

use App\Http\Controllers\BaseInsideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseInsideController
{
    public function login(Request $request)
    {
        Auth::shouldUse('inside');
        if (Auth()->guard('inside')->user()) {
            return redirect(Route('inside.dashboard'));
        }

        $data = array(
            'title' => 'Login'
        );

        if ($request->getMethod() == 'POST') {

            if (!Auth()->guard('inside')->attempt(['phone' => $request->phone, 'password' => $request->password], true)) {
                $request->session()->flash('msg', 'Đăng nhập thất bại');
            } else {
                return redirect(Route('inside.dashboard'));
            }

        }
        return view('inside.login', $data);
    }

    public function logout()
    {
        Auth::shouldUse('inside');
        if (Auth()->guard('inside')->user()->id) {
            Auth()->guard('inside')->logout();
        }
//        session_start();
//        session_destroy();
        return redirect(Route('inside.login'));
    }
}
