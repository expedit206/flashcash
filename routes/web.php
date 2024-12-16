<?php

// use Closure;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EpargneController;

use App\Http\Controllers\EpargneUserController;
use App\Http\Controllers\ParrainageController;
use App\Http\Controllers\PolitiqueController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProduitUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacheController;

use App\Http\Controllers\PromoCodeController;

use App\Http\Controllers\TacheUserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;



Route::get('produits/index', [ProduitController::class, 'index'])->name('produits.index')->middleware('auth');

Route::get('produits', [ProduitController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});    



Route::middleware(['auth'])->group(function () {
    Route::post('/produits/souscrire/{pack}', [CompteController::class, 'subscribe'])->name('produits.subscribe');
    Route::get('admin/utilisateur/{user}/{compte}/actualiser', [CompteController::class, 'actualiser'])->name('admin.utilisateur.actualiser');

    Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');

});    

Route::get('/mes-produits', [ProduitUserController::class, 'index'])->name('produit.user.index')->middleware('auth');
Route::post('/produit_user/store', [ProduitUserController::class, 'store'])->name('produit.user.store');

Route::get('/comptes', [CompteController::class, 'index'])->name('comptes.index')->middleware('auth');

// Route::get('/comptes/{user}/{pack}', [CompteController::class, 'show'])->name('comptes.show')->middleware('auth');
Route::get('/compte/{user}', [CompteController::class, 'show'])->name('compte.show')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/epargne', [EpargneController::class, 'index'])->name('epargne.index');
    // Route::post('/epargne', [EpargneController::class, 'store'])->name('epargne.store');
   
    Route::post('/mes-epargne/store', [EpargneUserController::class, 'store'])->name('epargne.user.store');
    Route::get('/mes-epargne/index', [EpargneUserController::class, 'index'])->name('epargne.user.index');
    Route::post('/mes-epargne/retirer/{EpargneUser}', [EpargneUserController::class, 'retirer'])->name('epargne.user.retirer');
});    
// web.php// routes/web.php


Route::get('/parrainage', [ParrainageController::class, 'index'])->middleware('auth')->name('parrainage.index')->middleware('auth');
Route::get('/parrainage/filleuls', [ParrainageController::class, 'showFilleul'])->name('filleuls')->middleware('auth');

Route::post('/retrait/{userId}/{compteId}', [CompteController::class, 'storeRetrait'])->name('retrait.store')->middleware('auth');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/{user}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
    
    
    Route::resource('produit_user', \App\Http\Controllers\Admin\ProduitUserController::class);
    
    Route::get('/transactions', [App\Http\Controllers\Admin\transactionController::class, 'index'])->name('admin.transactions');
    Route::get('/transactions/create', [App\Http\Controllers\Admin\transactionController::class, 'create'])->name('admin.transactions.create');
    Route::post('/transactions/store', [App\Http\Controllers\Admin\transactionController::class, 'store'])->name('admin.transactions.store');
    Route::get('/{transaction}/edit', [App\Http\Controllers\Admin\transactionController::class, 'edit'])->name('admin.transactions.edit');
    Route::put('/{transaction}/update', [App\Http\Controllers\Admin\transactionController::class, 'update'])->name('admin.transactions.update');
    Route::delete('/transactions/{transaction}', [App\Http\Controllers\Admin\transactionController::class, 'destroy'])->name('admin.transactions.destroy');
    


    // Route::get('/produit_users', [\App\Http\Controllers\Admin\ProduitUserController::class, 'index'])->name('admin.produit_users');
    // Route::get('/{produit_user}/edit', [App\Http\Controllers\Admin\ProduitUserController::class, 'edit'])->name('admin.produit_users.edit');
    // Route::put('/{produit_user}/update', [App\Http\Controllers\Admin\ProduitUserController::class, 'update'])->name('admin.produit_users.update');

    // Route::delete('/comptes/{user}', [uUerController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/comptes', [AdminController::class, 'allComptes'])->name('admin.all_comptes');

    Route::get('/user/{userId}/comptes', [AdminController::class, 'viewUserComptes'])->name('admin.user.comptes');
    Route::get('/comptes/{compte}/edit', [AdminController::class, 'editCompte'])->name('admin.comptes.edit');
    Route::put('/comptes/{compte}', [AdminController::class, 'updateCompte'])->name('admin.comptes.update');
    Route::delete('/comptes/{compte}', [CompteController::class, 'destroy'])->name('admin.comptes.destroy');

    // Statistiques administratives
    Route::get('/stats/retraits', [AdminController::class, 'totalRetraits'])->name('admin.stats.retraits');
    Route::get('/stats/comptes-pack', [AdminController::class, 'comptesParPack'])->name('admin.stats.comptes-pack');
    Route::get('/comptes-retraits', [AdminController::class, 'comptesAvecRetraits'])->name('admin.comptes.retraits');


    Route::get('/comptes/create', [CompteController::class, 'create'])->name('comptes.create');
    Route::post('/comptes/store', [CompteController::class, 'store'])->name('comptes.store');

});    

// Afficher le formulaire de modification du numéro de téléphone
Route::get('/profile/phone/{user}', [ProfileController::class, 'editPhone'])->name('profile.phone.edit')->middleware('auth');
// Traiter la demande de modification du numéro de téléphone
Route::patch('/profile/phone', [ProfileController::class, 'updatePhone'])->name('profile.phone.update')->middleware('auth');

Route::get('/politique-utilisation', [PolitiqueController::class, 'index'])->name('politique.utilisation');
// CRUD sur les comptes


// Route pour afficher les tâches de parrainage
Route::get('/taches', [TacheController::class, 'index'])->name('taches.index')->middleware('auth');
Route::get('/users-who-refer', [AdminController::class, 'parrain'])->name('users.refer')->middleware('auth');
Route::post('/tache_user/{tache}', [TacheUserController::class, 'recuperer'])->name('taches.recuperer')->middleware('auth');


// Route::post('/code/store', [CodeController::class, 'store'])->name('code.store');
    
// Route::get('/codes', [CodeController::class, 'index'])->name('code.index');




// Route pour afficher le formulaire de dépôt
Route::get('/deposit', [TransactionController::class, 'showDepositForm'])->name('deposit.form')->middleware('auth');;

// Route pour traiter le dépôt
Route::post('/deposit', [TransactionController::class, 'makeDeposit'])->name('deposit.submit')->middleware('auth');

// Route pour afficher le formulaire de retrait
Route::get('/withdraw', [TransactionController::class, 'showWithdrawalForm'])->name('withdraw.form')->middleware('auth');

// Route pour traiter le retrait
Route::post('/withdraw', [TransactionController::class, 'makeWithdrawal'])->name('withdraw.submit')->middleware('auth');

// Route pour afficher les transactions
Route::get('/transactions', [TransactionController::class, 'showTransactions'])->name('transactions.index')->middleware('auth');


Route::get('/showPasswordTransaction', [CompteController::class, 'showPasswordTransaction'])->name('showPasswordTransaction');
Route::post('/updatePasswordTransaction', [CompteController::class, 'updatePasswordTransaction'])->name('updatePasswordTransaction');





Route::get('/wallet/configure', [WalletController::class, 'showConfigurationForm'])->name('wallet.configure');
Route::post('/wallet/store', [WalletController::class, 'storeWallet'])->name('wallet.store');
Route::get('/wallet/edit/{wallet}', [WalletController::class, 'edit'])->name('wallet.edit');
Route::post('/wallet/update/{wallet}', [WalletController::class, 'update'])->name('wallet.update');

Route::get('/promo-code/create', [PromoCodeController::class, 'createPromoCode'])->name('codePromo-create');
Route::post('/promo-code/use', [PromoCodeController::class, 'usePromoCode'])->name('codePromo-usage');   
require __DIR__.'/auth.php';    
