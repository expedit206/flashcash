<?php

// use Closure;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolitiqueController;

Route::get('/', [PackController::class, 'index'])->name('packs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/packs/souscrire', [CompteController::class, 'subscribe'])->name('packs.subscribe');
    Route::get('admin/utilisateur/{user}/{compte}/actualiser', [CompteController::class, 'actualiser'])->name('admin.utilisateur.actualiser');
});


Route::get('/comptes', [CompteController::class, 'index'])->name('comptes.index')->middleware('auth');

Route::get('/comptes/{user}/{pack}', [CompteController::class, 'show'])->name('comptes.show')->middleware('auth');

// web.php// routes/web.php


Route::post('/retrait/{userId}/{compteId}', [CompteController::class, 'storeRetrait'])->name('retrait.store')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/comptes', [AdminController::class, 'allComptes'])->name('admin.all_comptes');

    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::get('/admin/user/{userId}/comptes', [AdminController::class, 'viewUserComptes'])->name('admin.user.comptes');
    Route::get('/admin/comptes/{compte}/edit', [AdminController::class, 'editCompte'])->name('admin.comptes.edit');
    Route::put('/admin/comptes/{compte}', [AdminController::class, 'updateCompte'])->name('admin.comptes.update');
    Route::delete('/admin/comptes/{compte}', [CompteController::class, 'destroy'])->name('admin.comptes.destroy');

    // Statistiques administratives
    Route::get('/admin/stats/retraits', [AdminController::class, 'totalRetraits'])->name('admin.stats.retraits');
    Route::get('/admin/stats/comptes-pack', [AdminController::class, 'comptesParPack'])->name('admin.stats.comptes-pack');
    Route::get('/admin/comptes-retraits', [AdminController::class, 'comptesAvecRetraits'])->name('admin.comptes.retraits');


    Route::get('/admin/comptes/create', [CompteController::class, 'create'])->name('comptes.create');
    Route::post('/admin/comptes/store', [CompteController::class, 'store'])->name('comptes.store');

});

// Afficher le formulaire de modification du numéro de téléphone
Route::get('/profile/phone/{user}', [ProfileController::class, 'editPhone'])->name('profile.phone.edit');
// Traiter la demande de modification du numéro de téléphone
Route::patch('/profile/phone', [ProfileController::class, 'updatePhone'])->name('profile.phone.update');

Route::get('/politique-utilisation', [PolitiqueController::class, 'index'])->name('politique.utilisation');

    // CRUD sur les comptes

require __DIR__.'/auth.php';
