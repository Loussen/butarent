<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();

        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$admin->id,
            'current_password' => 'required|string',
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        if (! Hash::check($data['current_password'], $admin->password)) {
            return back()
                ->withErrors(['current_password' => __('Current password is incorrect.')])
                ->withInput($request->except('current_password', 'password', 'password_confirmation'));
        }

        $admin->name = $data['name'];
        $admin->email = $data['email'];

        if (! empty($data['password'])) {
            $admin->password = Hash::make($data['password']);
        }

        $admin->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', __('Profile updated successfully.'));
    }
}
