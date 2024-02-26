<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 10px;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Laporan Transaksi</h2>
        @if ($tanggal_awal)
            <p>Tanggal Awal : {{ format_tanggal($tanggal_awal) }}</p>
        @endif
        @if ($tanggal_akhir)
            <p>Tanggal Awal : {{ format_tanggal($tanggal_akhir) }}</p>
        @endif
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Ongkos Kirim</th>
                    <th>Total Bayar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $transaksi)
                    <tr>
                        <td class="text-center" rowspan="{{ $transaksi->details->count() }}">{{ $loop->iteration }}</td>
                        <td rowspan="{{ $transaksi->details->count() }}">
                            {{ $transaksi->created_at->translatedFormat('d/m/Y') }}</td>
                        <td rowspan="{{ $transaksi->details->count() }}">{{ $transaksi->user->name }}</td>
                        <td rowspan="{{ $transaksi->details->count() }}">{{ format_rupiah($transaksi->ongkos_kirim) }}
                        </td>
                        <td rowspan="{{ $transaksi->details->count() }}">{{ format_rupiah($transaksi->total_bayar) }}
                        </td>
                        @foreach ($transaksi->details as $index => $detail)
                            @if ($index > 0)
                    </tr>
                    <tr>
                @endif
                <td>{{ $detail->produk->nama }}</td>
                <td>{{ format_rupiah($detail->harga) }}</td>
                <td class="text-center">{{ $detail->jumlah }}</td>
                <td>{{ format_rupiah($detail->total_harga) }}</td>
                @endforeach
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-center">Total</td>
                    <td colspan="5" class="text-center">{{ format_rupiah($transaksi->sum('total_bayar')) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
