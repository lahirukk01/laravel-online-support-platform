<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }

        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->route('admin_home');
        }
        return redirect()->route('agent_home');
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login_home');
    }
}
