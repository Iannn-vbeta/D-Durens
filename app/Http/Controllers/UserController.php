<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan role = 2
        $users = User::where('id_role', 2)->get();
        return view('admin.akunUser', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'id_role'  => 2
        ]);

        return redirect()->route('admin.akunUser')->with('success', 'User berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$user->id}",
        ]);

        $user->update([
            'username' => $request->username,
            'email'    => $request->email
        ]);

        return redirect()->route('admin.akunUser')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.akunUser')->with('success','User berhasil dihapus.');
    }
}