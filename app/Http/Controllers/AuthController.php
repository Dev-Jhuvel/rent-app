<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return inertia('Auth/Login');
    }

    public function authenticate(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($fields)) {
            $request->session()->regenerate();

            if (!auth()->user()->is_admin) {
                return redirect()->route('tenants.dashboard')->with('message', 'User Login Success!');
            }
            return redirect()->route('admins.dashboard')->with('message', 'Login Success!');
        }
        return back()->withErrors([
            'email' => 'The Provided credentials don\'t match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Logout Success!');
    }

    public function dashboard()
    {
        $bills = Bill::where([['user_id', auth()->user()->id], ['isPublished', 1]])->get();
        return inertia('Tenants/TenantDashboard', ['bills' =>  $bills]);
    }

    public function adminDashboard()
    {
        $users = User::where('house_id', '!=', 'null')->get();
        return inertia('Admins/AdminDashboard', ['users' =>  $users]);
    }

    public function profile(Request $request)
    {
        $user = User::find($request->user);
        return inertia('Auth/Profile', ['user' => $user]);
    }
}
