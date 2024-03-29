<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        h1 {
            font-size: 24px;
        }

        @media print {
            body {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Laporan Keuangan</h1>
            @if ($bulan)
                <p>Untuk Bulan: <strong>{{ getMonthName($bulan) }} {{ $tahun }}</strong></p>
            @endif
            @if ($tahun)
                Untuk Tahun: {{ $tahun }}
            @endif
        </header>
        <section class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td style="width: 10px">{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->translatedFormat('F Y') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ format_rupiah($item->nominal) }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">
                            Pemasukan
                        </td>
                        <td>
                            {{ $items ? format_rupiah($items->where('jenis', 'pemasukan')->sum('nominal')) : 'Rp 0' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">
                            Pengeluaran
                        </td>
                        <td>
                            {{ $items ? format_rupiah($items->where('jenis', 'pengeluaran')->sum('nominal')) : 'Rp 0' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">
                            Total
                        </td>
                        <td>
                            {{ $items ? format_rupiah($items->sum('nominal')) : 'Rp 0' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>
