<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('homepage.login');
        }
        return view('admin.index');
    }

    public function account()
    {
        $users = User::all();
        return view('admin.accounts.index', compact('users'));
    }


    public function create_account()
    {
        return view('admin.accounts.create');
    }

    public function store_account(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required'
        ]);

        $request['password'] = bcrypt(request('password'));
        User::create($request->all());

        return redirect()->route('admin.accounts.index')->with('success', 'User created successfully.');
    }

    public function edit_account(User $user)
    {
        return view('admin.accounts.edit', compact('user'));
    }

    public function update_account(Request $request, User $user)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required'
        ]);

        $data = $request->all();
        if ($request->filled('role')) {
            $data['role'] = $request->role;
        } else {
            $data['role'] = null;
        }

        $user->update($data);

        return redirect()->route('admin.accounts.index')->with('Success', 'User updated successfully.');
    }

    public function destroy_account(User $user)
    {
        $user->delete();

        return redirect()->route('admin.accounts.index')->with('Success', 'User deleted successfully.');
    }
}
