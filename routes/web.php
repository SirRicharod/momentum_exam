<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotholeReportController;

// Display the dashboard with all pothole reports (paginated)
Route::get('/', [PotholeReportController::class, 'index'])->name('reports.index');

// RESTful CRUD routes for creating, editing, updating, and deleting reports (excluding index and show)
Route::resource('reports', PotholeReportController::class)->except(['index', 'show']);

// One-click toggle to mark a report as fixed or reported
Route::patch('/reports/{report}/toggle-status', [PotholeReportController::class, 'toggleStatus'])->name('reports.toggle-status');
