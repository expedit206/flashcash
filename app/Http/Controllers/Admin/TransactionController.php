<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->orderBy('id', 'desc')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('admin.transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'type' => 'required|in:deposit,withdrawal',
            'status' => 'required|in:success,failed',
            'transaction_id' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        Transaction::create($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction créée avec succès.');
    }

    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'type' => 'required|in:deposit,withdrawal',
            'status' => 'required|in:success,failed',
            'transaction_id' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Transaction mise à jour avec succès.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction supprimée avec succès.');
    }
}