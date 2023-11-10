<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';
    public function login()
    {
        return view('auth/login');
    }
  
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), 
        [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();
  
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
  
        $request->session()->regenerate();

        // Ambil user saat ini
        $user = Auth::user();

        // Cek level user dan arahkan sesuai levelnya menggunakan middleware CekLevel
        if ($user->level === 1) {
            return redirect()->route('admin.ljkh');
        } elseif ($user->level === 2) {
            return redirect()->route('foreman.DashboardForeman');
        } elseif ($user->level === 3) {
            return redirect()->route('member.index');
        }
  
        return redirect()->route('home');
    }
  
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
