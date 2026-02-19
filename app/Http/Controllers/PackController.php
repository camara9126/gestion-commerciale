<?php

namespace App\Http\Controllers;

use App\Models\Pack;
use App\Models\PaiementAbonnement;
use App\Services\PayTech;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PackController extends Controller
{


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
            ->setCurrency('XOF')
             ->setCustomeField(['type_paiement' => 'changement_pack'])
            ->setRefCommand(uniqid())
            ->setQuery([
                'item_name' => $pack->nom,
                'item_price' => $pack->prix,
                'command_name' => "Changement Pack - {$pack->nom} via PayTech"
            ])

            ->setNotificationUrl([
                'success_url' => route('abonnement.success'),
                'cancel_url' => route('abonnement.cancel'),
                'ipn_url' => 'https://bmanager.bcmgroupe.com/abonnement/ipn',
            ])
            ->send();

        if ($response['success'] == 1) {
            // Redirection vers PayTech pour le paiement
            return redirect()->away($response['redirect_url']);
        }

        return redirect()->back()->with('error', 'Impossible d’initier le paiement.');
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
