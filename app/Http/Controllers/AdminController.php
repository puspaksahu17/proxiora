<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function createSubadmin(): View
    {
        return view('admin.create-subadmin');
    }

    public function storeSubadmin(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:25'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([...$data, 'role' => 'subadmin', 'password' => Hash::make($data['password'])]);

        return redirect()->route('dashboard')->with('status', 'Subadmin created successfully.');
    }

    public function assignStudent(Request $request, User $student): RedirectResponse
    {
        abort_unless($student->role === 'student', 404);

        $data = $request->validate([
            'assigned_subadmin_id' => ['nullable', 'exists:users,id'],
        ]);

        if (isset($data['assigned_subadmin_id']) && ! User::whereKey($data['assigned_subadmin_id'])->where('role', 'subadmin')->exists()) {
            return back()->withErrors(['assigned_subadmin_id' => 'Please select a valid subadmin.']);
        }

        $student->update(['assigned_subadmin_id' => $data['assigned_subadmin_id'] ?? null]);

        return back()->with('status', 'Student assignment updated.');
    }

    public function editUser(User $user): View
    {
        abort_unless(in_array($user->role, ['subadmin', 'student'], true), 404);

        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        abort_unless(in_array($user->role, ['subadmin', 'student'], true), 404);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'mobile' => ['required', 'string', 'max:25'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];

        if ($user->role === 'student') {
            $rules['work_status'] = ['required', 'in:experience,fresher'];
            $rules['progress'] = ['required', 'integer', 'min:0', 'max:100'];
        }

        $data = $request->validate($rules);
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('status', ucfirst($user->role).' updated successfully.');
    }

    public function destroyUser(User $user): RedirectResponse
    {
        abort_unless(in_array($user->role, ['subadmin', 'student'], true), 404);
        $role = $user->role;
        $user->delete();

        return back()->with('status', ucfirst($role).' deleted successfully.');
    }
}
