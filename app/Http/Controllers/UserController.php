<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::where('role', '!=', 'admin')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:member,operator',
            'no_identitas' => 'required|string|max:20|unique:users,no_identitas',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user): View
    {
        if ($user->isAdmin()) {
            abort(403, 'Tidak dapat mengedit admin');
        }
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            abort(403, 'Tidak dapat mengubah admin');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:member,operator',
            'no_identitas' => 'required|string|max:20|unique:users,no_identitas,' . $user->id,
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            abort(403, 'Tidak dapat menghapus admin');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }
}
