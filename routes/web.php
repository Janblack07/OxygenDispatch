<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\TankUnitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InventoryMovementController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Catalog\GasTypeController;
use App\Http\Controllers\Catalog\CylinderCapacityController;
use App\Http\Controllers\Catalog\WarehouseAreaController;
use App\Http\Controllers\Catalog\TechnicalStatusController;

Route::get('/', fn() => redirect()->route('dashboard'))->name('home');
// Breeze - Profile routes (necesarias para navigation.blade.php)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Catalogos
    Route::resource('catalog/gas-types', GasTypeController::class)->names('gas-types');
    Route::resource('catalog/capacities', CylinderCapacityController::class)->names('capacities');
    Route::resource('catalog/warehouse-areas', WarehouseAreaController::class)->names('warehouse-areas');
    Route::resource('catalog/technical-statuses', TechnicalStatusController::class)->names('technical-statuses');

    // Core
    Route::resource('clients', ClientController::class);
    Route::resource('batches', BatchController::class);
    Route::post('batches/{batch}/generate-tanks', [BatchController::class, 'generateTanks'])->name('batches.generate-tanks');

    Route::get('tanks', [TankUnitController::class, 'index'])->name('tanks.index');
    Route::get('tanks/{tank}', [TankUnitController::class, 'show'])->name('tanks.show');
    Route::post('tanks/{tank}/transfer', [TankUnitController::class, 'transfer'])->name('tanks.transfer');
    Route::post('tanks/{tank}/technical-status', [TankUnitController::class, 'changeTechnicalStatus'])->name('tanks.technical-status');
    Route::post('tanks/{tank}/decommission', [TankUnitController::class, 'decommission'])->name('tanks.decommission');

    Route::get('inventory/movements', [InventoryMovementController::class, 'index'])->name('inventory.movements');

    Route::get('dispatches', [DispatchController::class, 'index'])->name('dispatches.index');
    Route::get('dispatches/create', [DispatchController::class, 'create'])->name('dispatches.create');
    Route::post('dispatches', [DispatchController::class, 'store'])->name('dispatches.store');
    Route::get('dispatches/create-by-quantity', [DispatchController::class, 'createByQuantity'])->name('dispatches.create-by-quantity');
    Route::post('dispatches/store-by-quantity', [DispatchController::class, 'storeByQuantity'])->name('dispatches.store-by-quantity');
    Route::get('dispatches/{dispatch}', [DispatchController::class, 'show'])->name('dispatches.show');

    // Users protegido por roles
    Route::middleware(['role:PROGRAMADOR,ADMINISTRADOR'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    });
});

require __DIR__.'/auth.php';
