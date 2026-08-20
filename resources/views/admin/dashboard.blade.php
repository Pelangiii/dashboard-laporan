<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin - Laporan Masuk') }}
            </h2>
            <a href="{{ route('admin.reports.export-pdf') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm">
                Export PDF
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama User</th>
                            <th class="p-3">Judul Laporan</th>
                            <th class="p-3">Isi Laporan</th>
                            <th class="p-3">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $index => $report)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 font-medium">{{ $report->user->name }}</td>
                                <td class="p-3">{{ $report->judul }}</td>
                                <td class="p-3">{{ $report->isi_laporan }}</td>
                                <td class="p-3 text-sm text-gray-500">{{ $report->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500">Belum ada laporan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>