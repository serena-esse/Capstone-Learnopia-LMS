<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Validate the uploaded file
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
        ]);

        if ($request->hasFile('profile_image')) {
            Log::info('File caricato, iniziando il salvataggio.');

            // Store the file in the 'profile_images' disk
            $path = $request->file('profile_image')->store('profile_images', 'public');
            Log::info('Immagine profilo salvata in: ' . $path);

            // Save the path
            $data['profile_image'] = $path;
        } else {
            Log::error('File non caricato correttamente.');
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
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
