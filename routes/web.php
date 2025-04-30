<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountsController;
use Illuminate\Support\Facades\Route;
use App\Models\Account;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $result = Account::all();
    return view('dashboard', compact('result'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/create-account', function () {
        return view('createAccount');
    })->name('create.account');

    Route::post('/store-account', [AccountsController::class, 'storeAccount'])->name('store.account');
    Route::post('/view-account/transfer-amount', [AccountsController::class, 'transferAmount'])->name('transfer.amount');
    Route::get('/view-account/{id}', [AccountsController::class, 'viewAccount'])->name('view.account');
});

require __DIR__.'/auth.php';
