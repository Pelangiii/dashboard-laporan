<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection(): \Illuminate\Support\Collection
    {
        $query = Report::with('user')->latest();

        if ($this->request->filled('asal_teknisi')) {
            $query->where('asal_teknisi', $this->request->asal_teknisi);
        }

        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal & Waktu',
            'Nama Teknisi',
            'Bidang',
            'Lokasi',
            'Isi Kegiatan',
            'Status',
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->created_at->format('d/m/Y H:i') . ' WIB',
            $report->user->name ?? 'Staf Teknisi',
            $report->asal_teknisi,
            $report->lokasi,
            $report->isi_laporan,
            $report->status,
        ];
    }
}