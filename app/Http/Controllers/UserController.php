<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola Pengguna',
            'breadcrumbs' => [
                ['name' => 'Kelola Pengguna', 'url' => route('users.index')],
                ['name' => 'Daftar Pengguna', 'url' => route('users.index')],
            ],
            'users' => User::all()
        ];
        return view('users.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengguna',
            'breadcrumbs' => [
                ['name' => 'Kelola Pengguna', 'url' => route('users.index')],
                ['name' => 'Tambah Pengguna', 'url' => route('users.create')],
            ],
            'user' => null,
            'param' => 'add',
        ];
        return view('users.form', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,cashier',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $data = [
            'title' => 'Edit Pengguna',
            'breadcrumbs' => [
                ['name' => 'Kelola Pengguna', 'url' => route('users.index')],
                ['name' => 'Edit Pengguna', 'url' => route('users.edit', $id)],
            ],
            'user' => $user,
            'param' => 'edit',
        ];
        return view('users.form', $data);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|in:admin,cashier',
        ]);

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
