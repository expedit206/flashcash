<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
// use Hachther\MeSomb\Model\Deposit;
// use Hachther\MeSomb\Model\Transaction;
use Hachther\MeSomb\Operation\Payment\Collect;
use Hachther\MeSomb\Operation\Payment\Deposit;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showDepositForm()
    {
        return view('transactions.deposit');
    }

    public function makeDeposit(Request $request)
    {
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'phone' => 'required|string|digits_between:9,15',
            'amount' => 'required|numeric|min:100',
            'provider' => 'required',
            'password_transaction' => 'required|string', // Ajout de la validation pour le mot de passe de transaction  s
        ], [
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.digits_between:9,15' => 'Le numéro de téléphone doit contenir exactement 9 caractères.',
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être au moins 1000.',          
            'provider.required' => 'Le fournisseur est requis.',
        ]);
        
        $user = auth()->user();
        if (!\Hash::check($validatedData['password_transaction'], $user->password_transaction)) {
            return redirect()->back()->with('error', 'Mot de passe de transaction invalide.');
        }
        $paymentRequest = new Deposit(
            $validatedData['phone'],
            $validatedData['amount'], 
            \Str::upper($validatedData['provider']), 
            'CM', 
            'XAF'
        );
        $paymentResponse = $paymentRequest->pay();

        // Gérer la réponse du paiement
        if ($paymentResponse->success) {
        // die;

            Transaction::create([
                'user_id' => auth()->id(),
                'amount' => $validatedData['amount'],
                'type' => 'deposit',
                'status' => 'success',
                'transaction_id' => $paymentResponse->transaction->id,
                'payment_method' => 'MeSomb',
                'created_at' => now()->setTimezone('Africa/Douala'),

            ]);

            $user->solde_total -=  $validatedData['amount'];
            $user->save();

            return redirect()->route('transactions.index')->with('success', 'retrait réussi !');
        } else {
            return redirect()->back()->with('error', 'Échec du retrait verifier vos informations.');
        }
    }

    public function showWithdrawalForm()
    {
        return view('transactions.withdraw');
    }

    public function makeWithdrawal(Request $request)
    {
        // Validation des données d'entrée
        // dd($request);
        $user = auth()->user();

        $validatedData = $request->validate([
            'phone' => 'required|string|digits_between:9,15',
            'amount' => 'required|numeric|min:100',
            'provider' => 'required',
        ], [
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.digits_between:9,15' => 'Le numéro de téléphone doit contenir exactement 9 caractères.',
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être au moins 1000.',
            'provider.required' => 'Le fournisseur est requis.',
        ]);
        // Créer une instance de Collect pour le retrait
        $paymentRequest = new Collect(
            $validatedData['phone'],
            $validatedData['amount'],
            \Str::upper($validatedData['provider']),
            'CM', // pays
            'XAF', // devise (ajoutez le paramètre si nécessaire)
            true,  // frais (ou false si vous ne voulez pas les inclure)
            true,  // conversion (ou false si vous ne voulez pas effectuer de conversion)
            null,  // message (ou une chaîne si vous souhaitez en inclure un)
           url('mes-produits')  // URL de redirection
        );
        // Processus de paiement
        // dd($paymentRequest);
        $paymentResponse = $paymentRequest->pay();
        // dd($paymentResponse);
// die;
        // Gérer la réponse du paiement
        // dd($paymentResponse);
        if ($paymentResponse->success) {
            // die;
            $now = new \DateTime('now'); // Date actuelle

            Transaction::create([
                'user_id' => auth()->id(),
                'amount' => $validatedData['amount'],
                'type' => 'withdrawal',
                'status' => 'success',
                'transaction_id' => $paymentResponse->transaction->id,
                'payment_method' => 'MeSomb',
                'created_at' => now()->setTimezone('Africa/Douala'),
            ]);
            $user->solde_total +=  $validatedData['amount'];
            $user->save();
            return redirect()->route('transactions.index')->with('success', 'depot réussi !');
        } else {
            return redirect()->back()->with('error', 'Échec du depot : verifier vos informations.');
        }
    }

    public function showTransactions()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('transactions.index', compact('transactions'));
    }
}
