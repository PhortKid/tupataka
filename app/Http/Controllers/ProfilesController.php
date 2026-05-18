<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class ProfilesController extends Controller
{
    // Fungua ukurasa wa profile
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    // Update profile (email & phone)
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone_number' => 'nullable|string|max:15',
        ]);

        $user = Auth::user();
        $user->update([
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()     
                    ->letters()      
                    ->numbers()       
                    ->symbols()       
                    ->uncompromised()
            ]
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully!');
    }
}
