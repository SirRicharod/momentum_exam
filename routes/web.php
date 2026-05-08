<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotholeReportController;

Route::get('/', [PotholeReportController::class, 'index'])->name('reports.index');
Route::resource('reports', PotholeReportController::class)->except(['index', 'show']);
Route::patch('/reports/{report}/toggle-status', [PotholeReportController::class, 'toggleStatus'])->name('reports.toggle-status');
