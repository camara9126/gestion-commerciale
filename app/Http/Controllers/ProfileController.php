<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Entreprise;
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
     * Update the entreprise's profile information..
     */
    public function entrepriseUpdate(Request $request, string $entreprise)
    {
        $entreprise = Entreprise::FindOrFail($entreprise);

         $request->validate([
            'telephone' => 'nullable|string|max:50',
            'taux_tva' => 'numeric|max:100',
            'adresse' => 'nullable|string',
            'logo',
        ]);

        // Gestion des logo
        if ($request->hasFile('logo')) {
            $filename = time().$request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logo', $filename, 'public');
            $request['logo'] = '/storage/' . $path;
        }

        $entreprise->update([
            'telephone' => $request->telephone,
            'taux_tva' => $request->taux_tva,
            'adresse' => $request->adresse,
            'logo' => $path  ?? null,
        ]);

        // Lier l'utilisateur a l'entreprise
        $user= $request->user();
        $user->entreprise_id = $entreprise->id;
        $user->save();

        return redirect()->back()->with('success', 'Entreprise mise a jour avec success');
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
        // Verification limite utilisateur du pack
        $user = request()->user();
        $pack = $user->entreprise->pack;

        if($user->entreprise->users()->count() >= $pack->max_user) {

            return redirect()->back()->with('danger', 'Limite du pack atteinte. Passez au pack supérieur.');

        };

        return view('profile.addUser');
    }


}
