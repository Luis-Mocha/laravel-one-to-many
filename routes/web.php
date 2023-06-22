<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Importo i miei controller
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\ProjectGuestController;



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
    return view('guest.welcome');
});

//route per mostrare i progetti nella sezione guest
Route::resource('/projects', ProjectGuestController::class);
// ->parameters(
//     [
//     'projects' => 'project:slug'
//     ]
// )



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// qundo creo le mie crud "amministrative" voglio
// localhost:8000/admin/projects/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Utilizzo il mio controller custom per la dashboard
    Route::get('/', [DashboardController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/projects', ProjectController::class)->parameters(
        [
        'projects' => 'project:slug'
        ]
    );

});

require __DIR__.'/auth.php';
