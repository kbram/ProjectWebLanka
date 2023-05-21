<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/users/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('editUser');
Route::post('/user/{id}/update', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('updateUser');
Route::get('/dashboard/user/add', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('addUser');
Route::post('/store-user', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('storeUser');
Route::post('/user/delete/{id}', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('DeleteUser');
Route::post('/users/filter/{email}', [UserController::class, 'searchUser'])->middleware(['auth', 'verified'])->name('searchUser');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
