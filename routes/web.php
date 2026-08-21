<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Redirect otomatis berdasarkan Role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('dashboard');
    })->name('dashboard');

    // Route Kirim Laporan Teknisi
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');

    // Route Khusus Admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [ReportController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('admin.report.destroy');
        
        // Route Export Excel & PDF
        Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.export.excel');
        Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.export.pdf');
    });
});

require __DIR__.'/auth.php';