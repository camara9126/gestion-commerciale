<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Models\Pack;
use App\Models\PaiementAbonnement;
use Carbon\Carbon;
use App\Services\PayTech;
use Illuminate\Http\Request;

class AbonnementController extends Controller
{
    public function initialPaiement(PayTech $paytech)
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

        $response = $paytech->setQuery([
                'item_name' => $pack->nom,
                'item_price' => $pack->prix,
                'command_name' => "Paiement {$pack->nom} via PayTech",
            ])
            ->setCustomeField([
                'item_id' => $pack->id,
                'time_command' => time(),
                'ip_user' => $_SERVER['REMOTE_ADDR']
            ])
            ->setTestMode(true)
            ->setCurrency('XOF')
            ->setRefCommand(uniqid())
            ->setNotificationUrl([
                'success_url' => route('abonnement.success'),
                'cancel_url'  => route('abonnement.cancel'),
                'ipn_url'     => 'https://bmanager.bcmgroupe.com/abonnement.ipn',
            ])
            ->send();
        //dd($response);
        $data = $response;

        if ($data['success'] === 1) {
            header('Location: ' . $data['redirect_url']);
            exit;
        }
    }


    // Changement de pack
    public function changerPack(PayTech $paytech, Pack $p)
    {
        $entreprise = request()->user()->entreprise;
        $pack = Pack::findOrFail($p->id);

        // 1️⃣ Référence unique
        $refCommande = 'CHP-' . Carbon::now()->format('YmdHis') . '-' . uniqid();

        // Créer paiement_abonnement
        $paiement = PaiementAbonnement::create([
            'entreprise_id' => $entreprise->id,
            'pack_id' => $pack->id,
            'statut' => 'en_attente',
            'reference' => $refCommande,
            'montant' => $pack->prix
        ]);

        // Init PayTech
        $paytech = new PayTech(
            config('services.paytech.api_key'),
            config('services.paytech.api_secret'));

        $response = $paytech
            ->setTestMode(true)
            ->setCurrency('XOF')
            ->setRefCommand(uniqid())
            ->setQuery([
                'item_name' => 'Changement pack : '.$pack->nom,
                'item_price' => $pack->prix,
                'command_name' => 'Changement pack - '.$entreprise->nom
            ])
            ->setNotificationUrl([
                'success_url' => route('abonnement.success'),
                'cancel_url' => route('abonnement.cancel'),
                'ipn_url' => 'https://bmanager.bcmgroupe.com/abonnement.chp',
            ])
            ->send();

        if ($response['success'] == 1) {
            // Redirection vers PayTech pour le paiement
            return redirect()->away($response['redirect_url']);
        }

        return redirect()->back()->with('error', 'Impossible d’initier le paiement.');
    }

    // Validation changement de pack
     public function chp(Request $request)
    {
        $reference = $request->ref_command ?? null;
        $status    = $request->payment_status ?? null;

        if (!$reference) {
            return response('Référence manquante', 400);
        }
        
        $changement = PaiementAbonnement::where('reference', $reference)->first();

        if (!$changement) {
            return response('Paiement introuvable', 404);
        }

        // 🛑 Éviter les doubles traitements
        if ($changement->statut === 'payé') {
            return response('Déjà traité', 200);

        }

         $entreprise = $changement->entreprise;
         $pack = $changement->pack;


         if ($status === 'completed') {

          // ✅ Paiement validé
            $changement->update([
                'statut' => 'payé',
                'moyen_paiement' => $request->payment_method,
                'paid_at' => now(),
            ]);
         }

            // Mise a jour abonnement
            $abonnement = $entreprise->abonnement;

            $abonnement->update([
                'pack_id' => $pack->id,
                'montant' => $pack->montant,
                'date_debut' =>now(),
                'date_fin' => now()->addMonth(), // ou selon le pack
            ]);

            // Mise a jour entreprise
            $entreprise->update([
                'pack_id' => $pack->id,
                'abonnement_expire_le' => now()->addMonth(),
                'trial_actif' => false,
            ]);
    }


    // Validation paiement abonnement
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
                'paid_at' => now(),
            ]);

            $entreprise = $paiement->entreprise;

            // Date de creation de l'entreprise
            $debut = $entreprise->created_at;

            // Date de fin de l'abonnement
            $fin = $debut->copy()->addMonth();

            // Creer l'abonnement
            Abonnement::create([
                'entreprise_id' => $paiement->entreprise_id,
                'pack_id' => $paiement->pack_id,
                'statut' => 'payé',
                'montant' => $paiement->montant,
                'date_debut' =>$debut,
                'date_fin' => $fin, // ou selon le pack
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


    // Paiement Valide
    public function success(Request $request)
    {
        return view('dashboard.success', [
            'message' => 'Paiement en cours de validation. Merci de patienter.'
        ]);
    }

    
    // Paiement Invalide
    public function cancel(Request $request)
    {
        $packs = Pack::all();
        if ($request->ref_command) {
            $paiement = PaiementAbonnement::where('reference', $request->ref_command)->first();

            if ($paiement && $paiement->statut === 'en_attente') {
                $paiement->update([
                    'statut' => 'annulé'
                ]);
            }
        }

        return view('dashboard.cancel',compact('packs'), [
            'message' => 'Paiement annulé. Aucun montant n’a été débité.'
        ]);
    }
}