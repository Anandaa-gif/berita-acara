<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaAcaraController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BackboneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\LoginController;

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berita Acara
    Route::get('/berita-acara', [BeritaAcaraController::class, 'index'])->name('berita-acara.index')->middleware('permission:berita_acara_view');
    Route::post('/proses-cetak-excel', [BeritaAcaraController::class, 'exportExcel'])->name('berita-acara.export-excel')->middleware('permission:berita_acara_view');
    Route::get('/berita-acara/create', [BeritaAcaraController::class, 'create'])->name('berita-acara.create')->middleware('permission:berita_acara_create');
    Route::post('/berita-acara', [BeritaAcaraController::class, 'store'])->name('berita-acara.store')->middleware('permission:berita_acara_create');
    Route::get('/berita-acara/{berita_acara}', [BeritaAcaraController::class, 'show'])->name('berita-acara.show')->middleware('permission:berita_acara_view');
    Route::get('/berita-acara/{berita_acara}/download-pdf', [BeritaAcaraController::class, 'downloadPdf'])->name('berita-acara.download-pdf')->middleware('permission:berita_acara_view');
    Route::get('/berita-acara/{berita_acara}/edit', [BeritaAcaraController::class, 'edit'])->name('berita-acara.edit')->middleware('permission:berita_acara_edit');
    Route::put('/berita-acara/{berita_acara}', [BeritaAcaraController::class, 'update'])->name('berita-acara.update')->middleware('permission:berita_acara_edit');
    Route::delete('/berita-acara/{berita_acara}', [BeritaAcaraController::class, 'destroy'])->name('berita-acara.destroy')->middleware('permission:berita_acara_delete');

    // Maintenance
    Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index')->middleware('permission:maintenance_view');
    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store')->middleware('permission:maintenance_create');
    Route::get('/maintenance/{id}', [MaintenanceController::class, 'show'])->name('maintenance.show')->middleware('permission:maintenance_view');
    Route::put('/maintenance/{id}', [MaintenanceController::class, 'update'])->name('maintenance.update')->middleware('permission:maintenance_edit');
    Route::delete('/maintenance/{id}', [MaintenanceController::class, 'destroy'])->name('maintenance.destroy')->middleware('permission:maintenance_delete');

    // Vendor
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index')->middleware('permission:vendor_view');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store')->middleware('permission:vendor_create');
    Route::get('/vendor/{id}', [VendorController::class, 'show'])->name('vendor.show')->middleware('permission:vendor_view');
    Route::put('/vendor/{id}', [VendorController::class, 'update'])->name('vendor.update')->middleware('permission:vendor_edit');
    Route::delete('/vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy')->middleware('permission:vendor_delete');

    // Backbone
    Route::get('/backbone', [BackboneController::class, 'index'])->name('backbone.index')->middleware('permission:backbone_view');
    Route::post('/backbone', [BackboneController::class, 'store'])->name('backbone.store')->middleware('permission:backbone_create');
    Route::get('/backbone/{id}', [BackboneController::class, 'show'])->name('backbone.show')->middleware('permission:backbone_view');
    Route::put('/backbone/{id}', [BackboneController::class, 'update'])->name('backbone.update')->middleware('permission:backbone_edit');
    Route::delete('/backbone/{id}', [BackboneController::class, 'destroy'])->name('backbone.destroy')->middleware('permission:backbone_delete');

    // Admin Only: Users & Roles
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});
