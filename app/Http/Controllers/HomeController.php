<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Support;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([
            'nom_complet' =>'required',
            'email' => 'required',
            'entreprise' => 'required',
            'sujet' => 'required',
            'message' => 'nullable',
        ]);


        Message::create([
        'nom_complet' => $request->nom_complet,
        'email' => $request->email,
        'entreprise' => $request->entreprise,
        'sujet' => $request->sujet,
        'message' => $request->message,
        ]);

        return redirect()->back()->with('success', ' Votre message a été envoyé avec succès. Nous vous répondrons dans les 24h.');
    }

     public function edit(string $s)
    {
        // Variable cree pour echapper la racontre sur la page Edit
        $support= Support::where('id', 0)->get();

        $message= Message::findOrFail($s);
       //dd($support); 
        return view('bmanager.edit', compact('message','support'));
    }


     public function update(Request $request, string $message)
    {
        $message= Message::findOrFail($message);

        $request->validate([
            'statut' => 'required',
        ]);

       $message->update([
        'statut' => $request->statut,
        ]);

        return redirect()->route('entreprise.message')->with('success', 'Demande traitée avec success');
    }


    // Suppression Message
    public function destroy(string $id)
    {
         $message= Message::findOrFail($id);

         $message->destroy($id);

        return redirect()->route('entreprise.message')->with('success', 'Message supprimée avec succès');        

    }
}
