<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')
            ->paginate(10);

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }

    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    public function update(
        Request $request,
        User $user
    ) {
        $request->validate([
            'role' => [
                'required',
                'in:admin,business,individual'
            ]
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User updated successfully.'
            );
    }

    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with(
                'error',
                'Cannot delete yourself.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}
