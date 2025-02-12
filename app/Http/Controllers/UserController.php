<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Directly create the user without any validation
        $user = User::create([
            'name' => $request->name,
            'mobilenumber' => $request->mobilenumber,
            'email' => $request->email,
            'role' => $request->role,
            'userstatus' => $request->userstatus,
            'password' => Hash::make($request->password),
        ]);

        // Assign role using Spatie (ensure the role exists in the form)
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'User added successfully');
    }




}
