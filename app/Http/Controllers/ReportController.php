<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Simpan Laporan dari User
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string',
        ]);

        Report::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }

    // Tampilkan Semua Laporan (Untuk Admin)
    public function adminDashboard()
    {
        $reports = Report::with('user')->latest()->get();
        return view('admin.dashboard', compact('reports'));
    }

    // Cetak PDF Semua Laporan
    public function exportPdf()
    {
        $reports = Report::with('user')->get();
        $pdf = Pdf::loadView('pdf.reports', compact('reports'));
        return $pdf->download('laporan-semua-user.pdf');
    }
}