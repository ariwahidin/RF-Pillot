<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login(Request $request)
    {

        // dd($request);

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && $user->pass === $credentials['password']) {
            Auth::login($user);
            $response = array(
                'success' => true,
                'message' => 'Login successfully'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Username or password not match'
            );
        }

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
