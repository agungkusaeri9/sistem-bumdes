@extends('layouts.app')
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('{{ asset('assets/frontend') }}/images/bg-01.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Transaksi
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table responsive">
                                <table class="table nowrap table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Nomor HP</th>
                                            <th>Alamat</th>
                                            <th>Total Bayar</th>
                                            <th>Status</th>
                                            <th>Kurir</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->translatedFormat('d/m/Y') }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->nomor_hp }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ format_rupiah($item->total_bayar) }}</td>
                                                <td>{!! $item->status() !!}</td>
                                                <td>{{ $item->kurir }}</td>
                                                <td>{{ $item->metode_pembayaran->nama . '-' . $item->metode_pembayaran->nomor_rekening . ' a.n ' . $item->metode_pembayaran->atas_nama }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('transaksi.show', $item->uuid) }}"
                                                        class="btn btn-warning">Detail</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10" class="text-center">Tidak Ada Transaksi</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
