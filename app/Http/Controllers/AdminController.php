<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('homepage.login');
        }elseif (Auth::user()->role != "Admin") {
            return redirect()->back();
        }
        return view('admin.index');
    }

public function account()
{
    // $users = User::with('role')->orderBy('id', 'DESC')->paginate(15);
    if (Auth::user()->role != "Admin") {
        return redirect()->back();
    }
    $users = User::join('roles', 'users.role', '=', 'roles.id')
            ->select('users.id','users.fullname','users.email','users.address','users.phoneNumber','roles.role_name as role_name')
            ->get();
    return view('admin.accounts.index')->with('users', $users);
}


    public function create_account()
    {
        if (Auth::user()->role != "Admin") {
            return redirect()->back();
        }
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
        if (Auth::user()->role != "Admin") {
            return redirect()->back();
        }
        $roles = Role::all();
        // Load role_name manually
        $userRole = Role::find($user->role);
        return view('admin.accounts.edit', compact('user', 'roles', 'userRole'));
    }


    public function update_account(Request $request, User $user)
    {
        if (Auth::user()->role != "Admin") {
            return redirect()->back();
        }
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'address' => 'required',
            'phoneNumber' => 'required'
        ]);

        $data = $request->all();
        // Handle the role separately if it's nullable
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
