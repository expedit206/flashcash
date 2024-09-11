<?php

use Closure;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\ProfileController;

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
});


Route::get('/comptes', [CompteController::class, 'index'])->name('comptes.index')->middleware('auth');

Route::get('/comptes/{user}/{pack}', [CompteController::class, 'show'])->name('comptes.show')->middleware('auth');

// web.php// routes/web.php


Route::post('/retrait/{userId}/{compteId}', [CompteController::class, 'storeRetrait'])->name('retrait.store')->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::get('/admin/user/{userId}/comptes', [AdminController::class, 'viewUserComptes'])->name('admin.user.comptes');
});

Route::middleware(function ($request,Closure $next) {
    if (auth()->user() && auth()->user()->isAdmin()) {
        return $next($request);
    }
    return redirect('packs.index')->with('error', 'Vous n\'avez pas les autorisations nécessaires.');
})->group(function () {
    // Liste de tous les utilisateurs
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');

    // Voir les comptes d'un utilisateur spécifique
    Route::get('/admin/users/{user}/comptes', [AdminController::class, 'showUserComptes'])->name('admin.users.comptes.show');

    // CRUD sur les comptes
    Route::get('/admin/comptes/{compte}/edit', [AdminController::class, 'editCompte'])->name('admin.comptes.edit');
    Route::put('/admin/comptes/{compte}', [AdminController::class, 'updateCompte'])->name('admin.comptes.update');
    Route::delete('/admin/comptes/{compte}', [AdminController::class, 'destroyCompte'])->name('admin.comptes.destroy');

    // Statistiques administratives
    Route::get('/admin/stats/retraits', [AdminController::class, 'totalRetraits'])->name('admin.stats.retraits');
    Route::get('/admin/stats/comptes-pack', [AdminController::class, 'comptesParPack'])->name('admin.stats.comptes-pack');
});

require __DIR__.'/auth.php';
