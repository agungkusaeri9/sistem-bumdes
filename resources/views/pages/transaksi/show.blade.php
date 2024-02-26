@extends('layouts.app')
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('{{ asset('assets/frontend') }}/images/bg-01.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Detail Transaksi
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-104 p-b-116">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor HP</th>
                                        <td>{{ $item->nomor_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $item->alamat }}</td>
                                    </tr>

                                    <tr>
                                        <th>Kurir</th>
                                        <td>{{ $item->kurir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Resi</th>
                                        <td>{{ $item->nomor_resi }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Ongkos Kirim</th>
                                        <td>{{ format_rupiah($item->ongkos_kirim) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar</th>
                                        <td>{{ format_rupiah($item->total_bayar) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td>{{ $item->metode_pembayaran->nama . '-' . $item->metode_pembayaran->nomor_rekening . ' a.n ' . $item->metode_pembayaran->atas_nama }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{!! $item->status() !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            @if ($item->bukti_pembayaran)
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm">Upload Bukti</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($item->details as $detail)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <td>{{ $detail->produk->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Harga</th>
                                        <td>{{ format_rupiah($detail->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah</th>
                                        <td>{{ $detail->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Harga</th>
                                        <td>{{ format_rupiah($detail->total_harga) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
