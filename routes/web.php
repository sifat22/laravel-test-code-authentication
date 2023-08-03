<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/admin-panel', function () {
    return view('admins.index');
})->middleware(['auth', 'verified'])->name('admin-panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin All Route

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout','destroy')->name('logout.page');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile','editprofile')->name('admin.edit.profile');
    Route::post('/store/profile','Storeprofile')->name('admin.store.profile');
    Route::get('/change/password','ChangePassword')->name('admin.change.password');
    Route::post('/update/password','UpdatePassword')->name('admin.update.password');


});



require __DIR__.'/auth.php';
