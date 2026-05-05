<?php

use App\Models\Organo;
use App\Models\Bien;
use App\Models\Custodio;
use App\Models\Inventario;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');

    // ─── Módulo: Órganos / Entidades ───
    Route::prefix('organos')->name('organos.')->group(function () {
        Route::get('/', fn () => view('organos.index'))->name('index');
        Route::get('/crear', fn () => view('organos.create'))->name('create');
        Route::get('/{organo}', fn (Organo $organo) => view('organos.show', compact('organo')))->name('show');
        Route::get('/{organo}/editar', fn (Organo $organo) => view('organos.edit', compact('organo')))->name('edit');
    });

    // ─── Módulo: Bienes Nacionales ───
    Route::prefix('bienes')->name('bienes.')->group(function () {
        Route::get('/', fn () => view('bienes.index'))->name('index');
        Route::get('/crear', fn () => view('bienes.create'))->name('create');
        Route::get('/{bien}', fn (Bien $bien) => view('bienes.show', compact('bien')))->name('show');
        Route::get('/{bien}/editar', fn (Bien $bien) => view('bienes.edit', compact('bien')))->name('edit');
    });

    // ─── Módulo: Custodios ───
    Route::prefix('custodios')->name('custodios.')->group(function () {
        Route::get('/', fn () => view('custodios.index'))->name('index');
        Route::get('/crear', fn () => view('custodios.create'))->name('create');
        Route::get('/{custodio}', fn (Custodio $custodio) => view('custodios.show', compact('custodio')))->name('show');
    });

    // ─── Módulo: Ubicaciones ───
    Route::prefix('ubicaciones')->name('ubicaciones.')->group(function () {
        Route::get('/', fn () => view('ubicaciones.index'))->name('index');
    });

    // ─── Módulo: Inventarios ───
    Route::prefix('inventarios')->name('inventarios.')->group(function () {
        Route::get('/', fn () => view('inventarios.index'))->name('index');
        Route::get('/crear', fn () => view('inventarios.create'))->name('create');
        Route::get('/{inventario}', fn (Inventario $inventario) => view('inventarios.show', compact('inventario')))->name('show');
    });

    // ─── Módulo: Movimientos ───
    Route::prefix('movimientos')->name('movimientos.')->group(function () {
        Route::get('/', fn () => view('movimientos.index'))->name('index');
    });

    // ─── Módulo: Actas ───
    Route::prefix('actas')->name('actas.')->group(function () {
        Route::get('/', fn () => view('actas.index'))->name('index');
    });

    // ─── Módulo: Reportes ───
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', fn () => view('reportes.index'))->name('index');
    });
});

require __DIR__.'/settings.php';
