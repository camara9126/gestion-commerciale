<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Abonnement;
use App\Models\Entreprise;
use App\Models\Pack;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $packs = Pack::all();
        return view('home.register', compact('packs'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['string', 'max:250'],
            'entreprise_nom' => ['required'],
            'taux_tva' ,
            'telephone' => ['required'],
            'pack_id' => ['required'],
        ]);
        //dd($request);

        $entreprise= Entreprise::create([
            'nom' =>$request->entreprise_nom,
            'pack_id' => $request->pack_id,
            'taux_tva' => $request->taux_tva ?? 18,
            'telephone' => $request->telephone,
            'trial_actif' =>true,
            'trial_fin' => now()->addDay(25),
            'abonnement_expire_le' => now()->addMonth(),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'admin',
            'entreprise_id' => $entreprise->id
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Envoi de notification après création du user
        $admin = User::where('id', 2)->first();
//dd($admin);
        $admin->notify(new NewUserNotification($user));

        return redirect(route('dashboard.index', absolute: false));
    }
}
