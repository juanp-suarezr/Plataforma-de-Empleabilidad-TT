<?php

use App\Http\Controllers\BusquedaOfertasController;
use App\Http\Controllers\GestionEventosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OfertasController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Route::resource('ofertas', OfertasController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/buscarOfertas', [BusquedaOfertasController::class, 'index'])->name('buscarOfertas');

    // Route::get('/ofertas', [OfertasController::class, 'index'])->name('ofertas');
    


});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class)->middleware('auth');
    Route::resource('roles', RoleController::class);
    Route::resource('eventos', GestionEventosController::class);
    
   
    
});



require __DIR__.'/auth.php';
