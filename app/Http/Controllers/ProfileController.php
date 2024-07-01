<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($request->has('email') && $user->email !== $request->input('email')) {
            $user->email = $request->input('email');
            $user->email_verified_at = null;
        }

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName); // Move image to public/images directory
            // You can save $imageName to the database or use it as needed
        }

        $user->save();

        // Update password if provided
        if ($request->filled('oldPassword') && $request->filled('newPassword') && $request->filled('confirmPassword')) {
            $validated = $request->validate([
                'oldPassword' => ['required', 'current_password'],
                'newPassword' => ['required', 'confirmed', Password::defaults()],
            ]);
    
            $user->update([
                'password' => Hash::make($validated['newPassword']),
            ]);
        }

        return Redirect::route('plants.index')->with('status', 'Profile updated!');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
