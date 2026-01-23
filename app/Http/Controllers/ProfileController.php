<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfileController extends Controller
{
    use AuthorizesRequests;

    public function compte()
    {
        $users = User::where('entreprise_id', request()->user()->entreprise_id)->get();

        return view('profile.users', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['string', 'max:250'],
        ]);
        //dd($request);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'admin',
            'entreprise_id' => $request->user()->entreprise_id,
        ]);

        return redirect()->route('user.adduser')
            ->with('success', 'Utilisateur ajouté avec succès');
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(User $user) //RedirectResponse
    {
        //$request->validateWithBag('userDeletion', [
           // 'password' => ['required', 'current_password'],
        //]);

        //$user = $request->user();

        //Auth::logout();

        $this->authorize('delete', $user);
        $user->delete();

        return redirect()->back()->with('success', 'Utilisateur supprimé avec success');
        //$request->session()->invalidate();
        //$request->session()->regenerateToken();

        //return Redirect::to('/');
    }

    /**
     * Ajout user par l'admin.
     */
    public function addUser()
    {
        return view('profile.addUser');
    }


}
