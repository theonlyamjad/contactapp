<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return auth()->check()
        ? redirect()->route('dashboard')
        : view('welcome');
})->name('welcome');

Route::get('/debug-auth', function () {
    return response()->json(Auth::user());
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('person')->name('person.')->group(function () {
    Route::get('/', [PersonController::class, 'index'])->name('index');
    Route::get('/create', [PersonController::class, 'create'])->name('create');
    Route::post('/store', [PersonController::class, 'store'])->name('store');
    Route::post('/import', [PersonController::class, 'import'])->name('import');
    Route::get('/export', [PersonController::class, 'export'])->name('export');
    Route::get('/{person}/show/generate-pdf', [PersonController::class, 'generatePdf'])->name('generatePdf');
    Route::get('/{person}/show', [PersonController::class, 'show'])->name('show');
    Route::get('/{person}/edit', [PersonController::class, 'edit'])->name('edit');
    Route::put('/{person}/update', [PersonController::class, 'update'])->name('update');
    Route::delete('/{person}/destroy', [PersonController::class, 'destroy'])->name('destroy');
});

Route::controller(BusinessController::class)->prefix('business')->name('business')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::get('/create', 'create')->name('.create');
    Route::post('/store', 'store')->name('.store');
    Route::post('/import', 'BusinessController@import')->name('import');
    Route::get('/export','BusinessController@export')->name('export');
    Route::get('/{business}/show/generate-pdf', [BusinessController::class, 'generatePdf'])->name('business.generatePdf');
    Route::get('/{business}/show', 'show')->name('.show');
    Route::get('/{business}/edit', 'edit')->name('.edit');
    Route::put('/{business}/update', 'update')->name('.update');
    Route::delete('/{business}/destroy', [BusinessController::class, 'destroy'])->name('destroy');
});

Route::controller(TaskController::class)->prefix('task')->name('task')->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('.index');
    Route::post('/store', 'store')->name('.store');
    Route::put('/{task}/complete', 'complete')->name('.complete');
});

require __DIR__.'/auth.php';