<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Pack;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $comptes = Compte::where('user_id', $user->id)->get();
        return view('comptes.index', compact('comptes'));
    }

    public function create()
{
    $users = User::orderBy('created_at', 'asc')->get();  // Récupérer tous les utilisateurs avec leurs téléphones
    $produits = Pack::orderBy('created_at', 'asc')->get();  // Récupérer tous les produits

    return view('admin.add_compte', compact('users', 'produits'));
}

public function store(Request $request)
{
    // Validation des données entrantes
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'pack_id' => 'required|exists:produits,id',
    ]);

    $exists = \DB::table('comptes')
    ->where('user_id', $request->user_id)
    ->where('pack_id', $request->pack_id)
    ->exists();

if ($exists) {
    return redirect()->back()->withError('Cette combinaison de utilisateur et pack existe déjà.');
}
    // Création du compte avec les données soumises
    \DB::table('comptes')->insert([
        'user_id' => $request->user_id,
        'pack_id' => $request->pack_id,
        'solde_actuel' => 0,
        'a_fait_retrait' => false,
        'montant_retrait_total' => 0,
        'montant_retrait' => 0,
        'last_incremented_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Compte créé avec succès.');
}

public function show(User $user)
{
    $totalDeposits = Transaction::where('type', 'withdrawal')
    ->where('user_id', $user->id)->sum('amount');

    $user->depot_total = $totalDeposits;
    // dump($totalDeposits);
    $totalWithdrawals = Transaction::where('type', 'deposit')
    ->where('user_id', $user->id)->sum('amount');
    $user->retrait_total = $totalWithdrawals;
    // dd($totalWithdrawals);
    
    $totalBalance = $user->solde_total;
// dd($totalDeposits);
    return view('comptes.show', [
        'user' => $user,
        'totalBalance' => $totalBalance,
        'totalDeposits' => $totalDeposits,
        'totalWithdrawals' => $totalWithdrawals,
        // 'transactions' => $user->transactions()->latest()->take(5)->get(),
    ]);
}
 
public function destroy($id)
{
    // Validation pour vérifier si le compte existe
    $compte = DB::table('comptes')->find($id);

    if (!$compte) {
        return redirect()->back()->with('error','Compte non trouvé.');
    }

    // Suppression du compte
    DB::table('comptes')->where('id', $id)->delete();

    // Redirection avec message de succès
    return redirect()->route('admin.all_comptes')->with('success', 'Compte supprimé avec succès.');
}


public function showPasswordTransaction()
    {
        return view('transactions.password_update');
    }

        public function updatePasswordTransaction(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password_transaction' => 'required|string|min:8|confirmed',
            ]);
    
            $user = Auth::user();
    
            // die;
            // Vérifier le mot de passe actuel
            if (!\Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Le mot de passe de connexion est incorrect.']);
            }
    
            // Mettre à jour le mot de passe de transaction
            $user->password_transaction = \Hash::make($request->password_transaction);
            $user->save();
            return redirect()->back()->with('success', 'Mot de passe de transaction mis à jour avec succès.');
        }

}
