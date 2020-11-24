<?php

namespace App\Http\Controllers;

use App\Mail\AgentCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() {
        $agents = User::where('role', 'agent')->get();
        return view('admin.home', [
            'user' => Auth::user(),
            'agents' => $agents
            ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|min:6|confirmed|alpha_dash'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent'
        ]);

        Mail::to($user->email)->queue(new AgentCreated($request->name, $request->email, $request->password));
        return redirect()->route('admin_home')->with([
            'status' => 'Agent created '
        ]);
    }
}
