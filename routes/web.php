<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/home', function () {
    $user = Auth::user();
    $transactions = Transaction::where('user_id', $user->id)->get();
    $title = 'Home';

    return Inertia::render('Home')
        ->with('user', $user)
        ->with('transactions', $transactions)
        ->withViewData(['title' => $title]);
})->middleware(['auth', 'verified'])->name('home');

Route::get('/transaction', function () {
    $user = Auth::user();
    $transactions = Transaction::where('user_id', $user->id)->get();
    $title = 'Home';

    // dd($user, $transactions);
    return Inertia::render('Transaction')
        ->with('user', $user)
        ->with('transactions', $transactions)
        ->withViewData(['title' => $title]);
})->middleware(['auth', 'verified'])->name('transaction');


Route::get('/create', [TransactionController::class, 'create']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
