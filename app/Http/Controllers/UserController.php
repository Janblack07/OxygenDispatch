<?php

namespace App\Http\Controllers;

use App\Enums\AppRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(15);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create', ['roles' => AppRole::cases()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:150'],
            'email' => ['required','email','max:150','unique:users,email'],
            'role' => ['required','in:'.implode(',', AppRole::values())],
            'password' => ['nullable','string','min:8'],
        ]);

        $password = $data['password'] ?? Str::random(12).'!';

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        return redirect()->route('users.index')->with('success',"Usuario creado. Password: $password");
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user'=>$user, 'roles'=>AppRole::cases()]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required','string','max:150'],
            'email' => ['required','email','max:150','unique:users,email,'.$user->id],
            'role' => ['required','in:'.implode(',', AppRole::values())],
        ]);

        $user->update($data);
        return redirect()->route('users.index')->with('success','Usuario actualizado.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','Usuario eliminado.');
    }

    public function toggleActive(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return back()->with('success','Estado actualizado.');
    }

    public function resetPassword(User $user)
    {
        $new = Str::random(12).'!';
        $user->password = Hash::make($new);
        $user->save();
        return back()->with('success',"Nueva contraseña: $new");
    }
}
