<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\PaiementAbonnement;
use Carbon\Carbon;
use App\Services\PayTech;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function initialPaiement()
    {
        $entreprise = request()->user()->entreprise;
        $pack = $entreprise->pack;

        // 1️⃣ Référence unique
        $refCommande = 'ABN-' . Carbon::now()->format('YmdHis') . '-' . uniqid();

        // 2️⃣ Enregistrer le paiement en attente
        PaiementAbonnement::create([
            'entreprise_id' => $entreprise->id,
            'pack_id'       => $pack->id,
            'montant'       => $pack->prix,
            'reference'     => $refCommande,
            'statut'        => 'en_attente',
            'paid_at'       => now(),
        ]);
        //dd($paiement);

        // 3️⃣ Initialisation PayTech
        $paytech = new PayTech(
            config('services.paytech.api_key'),
            config('services.paytech.api_secret')
        );

        // 4️⃣ Envoi vers PayTech
        $response = $paytech->setQuery([
                'item_name'   => 'Abonnement ' . $pack->nom,
                'item_price'  => $pack->prix,
                'command_name'=> 'Abonnement ' . $pack->nom . ' - ' . $entreprise->nom,
            ])
            ->setRefCommand($refCommande)
            ->setNotificationUrl([
                'success_url' => route('abonnement.success'),
                'cancel_url'  => route('abonnement.cancel'),
                'ipn_url'     => route('abonnement.ipn'),
            ])
            ->send();
        //dd($response);

        // 5️⃣ Redirection
        if (isset($response['success']) && $response['success'] == 1) {
            return redirect()->away($response['redirect_url']);
        }

        return back()->withErrors([
            'paiement' => $response['message'] ?? 'Erreur PayTech'
            ]);
    }


    // Paiement Valide
    public function success(Request $request)
    {
        return view('dashboard.abonnement', [
            'message' => 'Paiement en cours de validation. Merci de patienter.'
        ]);
    }


    public function ipn(Request $request)
    {
        $reference = $request->ref_command ?? null;
        $status    = $request->payment_status ?? null;

        if (!$reference) {
            return response('Référence manquante', 400);
        }
        
        $paiement = PaiementAbonnement::where('reference', $reference)->first();

        if (!$paiement) {
            return response('Paiement introuvable', 404);
        }

        // 🛑 Éviter les doubles traitements
        if ($paiement->statut === 'payé') {
            return response('Déjà traité', 200);
        }

        if ($status === 'completed') {

            // ✅ Paiement validé
            $paiement->update([
                'statut' => 'payé',
                'moyen_paiement' => $request->payment_method,
                'paid_at' => now()
            ]);

            $entreprise = $paiement->entreprise;

            // Creer l'abonnement
            Abonnement::create([
                'entreprise_id' => $paiement->entreprise_id,
                'pack_id' => $paiement->pack_id,
                'statut' => 'payé',
                'date_debut' =>$entreprise->created_at,
                'date_fin' => $entreprise->abonnement_expire_le->addMonth(), // ou selon le pack
            ]);


            // 📅 Activation ou prolongation abonnement
            $expiration = $entreprise->abonnement_expire_le;

            $entreprise->update([
                'trial_actif' => false,
                'abonnement_expire_le' =>
                    $expiration && $expiration->isFuture()
                        ? $expiration->addMonth()
                        : now()->addMonth()
            ]);

            return response('OK', 200);
        }

        // ❌ Paiement échoué
        $paiement->update([
            'statut' => 'annulé'
        ]);

        return response('Paiement échoué', 200);
    }

    
    // Paiement Invalide
    public function cancel(Request $request)
    {
        if ($request->ref_command) {
            $paiement = PaiementAbonnement::where('reference', $request->ref_command)->first();

            if ($paiement && $paiement->statut === 'en_attente') {
                $paiement->update([
                    'statut' => 'annulé'
                ]);
            }
        }

        return view('dashboard.abonnement', [
            'message' => 'Paiement annulé. Aucun montant n’a été débité.'
        ]);
    }



}