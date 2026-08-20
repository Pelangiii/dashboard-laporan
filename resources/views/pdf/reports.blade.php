<!DOCTYPE html>
<html>
<head>
    <title>Laporan User</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data Laporan Masuk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama User</th>
                <th>Judul</th>
                <th>Isi Laporan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $index => $report)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $report->user->name }}</td>
                <td>{{ $report->judul }}</td>
                <td>{{ $report->isi_laporan }}</td>
                <td>{{ $report->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>