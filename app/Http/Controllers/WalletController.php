<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{
    public function showConfigurationForm()
    {
        // Récupérer les données du portefeuille de l'utilisateur
        $user = Auth::user();
        return view('wallet.configure', compact('user'));
    }


    public function storeWallet(Request $request)
{
// die;    
    // Validation des données
    $request->validate([
        'account_number' => [
            'required',
            'string',
            // Vérifiez que le numéro de compte est unique pour l'utilisateur
            \Illuminate\Validation\Rule::unique('wallets')->where(function ($query) {
                return $query->where('user_id', Auth::id());
            }),
        ],
        'service_name' => 'required|string',
        'user_name' => 'required|string',
    ]);

    // Récupérer l'utilisateur authentifié
    $user = Auth::user();

    // Créer un nouveau portefeuille
    $user->wallets()->create([
        'account_number' => $request->account_number,
        'service_name' => $request->service_name,
        'user_name' => $request->user_name,
    ]);

    // Redirection avec un message de succès
    return redirect()->route('wallet.configure')->with('success', 'Portefeuille enregistré avec succès!');
}
public function edit(Wallet $wallet)
{
    $user = Auth::user();

     // Récupérer le portefeuille
    return view('wallet.configure', compact('wallet', 'user')); // Affiche le formulaire de modification
}

public function update(Request $request, $id)
{
    // Validation des données
    $request->validate([
        'account_number' => 'required|string',
        'service_name' => 'required|string',
        'user_name' => 'required|string',
    ]);

    // Récupérer le portefeuille
    $wallet = Wallet::findOrFail($id);

    // Mettre à jour le portefeuille
    $wallet->update([
        'account_number' => $request->account_number,
        'service_name' => $request->service_name,
        'user_name' => $request->user_name,
    ]);

    // Redirection avec un message de succès
    return redirect()->route('wallet.configure')->with('success', 'Portefeuille mis à jour avec succès!');
}
}
