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
            'phone' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'customer' => 'required|string',
            'location' => 'required|string',
            'product' => 'required|string',
        ]);
        
        // Créer une instance de Deposit
        $paymentRequest = new Deposit($validatedData['phone'], $validatedData['amount'], 'MTN', 'CM');
        // Processus de paiement
        $paymentResponse = $paymentRequest->pay();

        // Gérer la réponse du paiement
        if ($paymentResponse->success) {
            Transaction::create([
                'user_id' => auth()->id(),
                'amount' => $validatedData['amount'],
                'type' => 'deposit',
                'status' => 'success',
                'transaction_id' => $paymentResponse->transaction->id,
                'payment_method' => 'MeSomb',
            ]);
            return redirect()->route('transactions.index')->with('success', 'Dépôt réussi !');
        } else {
            return redirect()->back()->with('error', 'Échec du dépôt.');
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
        $validatedData = $request->validate([
            'phone' => 'required|string|min:9|max:9',
            'amount' => 'required|numeric|min:1000',
            'provider' => 'required',
        ], [
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
            'phone.min' => 'Le numéro de téléphone doit contenir exactement 9 caractères.',
            'phone.max' => 'Le numéro de téléphone doit contenir exactement 9 caractères.',
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
        $paymentResponse = $paymentRequest->pay();
        // dd($paymentResponse);
// die;
        // Gérer la réponse du paiement
        // dd($paymentResponse);
        if ($paymentResponse->success) {
            Transaction::create([
                'user_id' => auth()->id(),
                'amount' => $validatedData['amount'],
                'type' => 'withdrawal',
                'status' => 'success',
                'transaction_id' => $paymentResponse->transaction->id,
                'payment_method' => 'MeSomb',
            ]);
            return redirect()->route('transactions.index')->with('success', 'Retrait réussi !');
        } else {
            return redirect()->back()->with('error', 'Échec du retrait : verifier votre solde et choisissez le service correspondant.');
        }
    }

    public function showTransactions()
    {
        $transactions = Transaction::where('user_id', auth()->id())->get();
        return view('transactions.index', compact('transactions'));
    }
}
