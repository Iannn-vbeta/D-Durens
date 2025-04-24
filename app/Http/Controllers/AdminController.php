<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan role = 1
        $users = User::where('id_role', 1)->get();
        return view('admin.akunAdmin', compact('users'));
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
            'id_role'  => 1
        ]);

        return redirect()->route('admin.akunAdmin')->with('success', 'Admin berhasil ditambahkan.');
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
            'email'    => $request->email,
        ]);

        return redirect()->route('admin.akunAdmin')->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.akunAdmin')->with('success','Admin berhasil dihapus.');
    }
}