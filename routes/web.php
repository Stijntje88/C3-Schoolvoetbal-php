<?php

use Faker\Provider\Base;
use App\Models\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\ProfileController;

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

Route::get('/user', function () {
    return redirect()->route('profiles.user', Auth::id());
});



Route::get('/', [BaseController::class, 'home'])->name('home');
Route::get('/home', [BaseController::class, 'home'])->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/admin/users', [BaseController::class, 'index'])->name('users.index');
    Route::get('/admin/user/{user}/edit', [BaseController::class, 'userEdit'])->name('users.edit');
    Route::put('/admin/user/{user}/edit', [BaseController::class, 'userUpdate'])->name('users.update');
    Route::delete('/admin/user/{user}/delete', [BaseController::class, 'userDestroy'])->name('users.delete');
    Route::get('/adminPanel', [BaseController::class, 'admin'])->name('admin.adminPanel');

    Route::get('/admin/tournaments', [TournamentsController::class, 'index'])->name('tournaments.index');
    Route::get('/admin/tournament/{tournament}/edit', [TournamentsController::class, 'edit'])->name('tournaments.edit');
    Route::put('/admin/tournament/{tournament}/edit', [TournamentsController::class, 'update'])->name('tournaments.update');

    Route::get('/generateMatches', [GamesController::class, 'generateMatches'])->name('generate.matches');
});




Route::post('/logout', [BaseController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\TournamentsController;
use Illuminate\Database\Console\Migrations\BaseCommand;

Route::get('/teambeheer', [TeamsController::class, 'index'])->name('teams.index');
Route::post('/teambeheer', [TeamsController::class, 'store'])->name('teams.store');
Route::get('/mijn-team', [TeamsController::class, 'mijnTeam'])->name('teams.mijnTeam');
Route::get('/teams/{team}/edit', [TeamsController::class, 'edit'])->name('teams.edit');
Route::put('/teams/{team}', [TeamsController::class, 'update'])->name('teams.update');





require __DIR__ . '/auth.php';
