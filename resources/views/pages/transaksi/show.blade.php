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
                                                <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank"
                                                    class="btn btn-info btn-sm">Lihat</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#uploadBuktiPembayaran">Upload Bukti</a>
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
                                    @if ($item->status === 'SELESAI' && !$detail->ulasan)
                                        <tr>
                                            <th>Ulasan</th>
                                            <td>
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalUlasan"
                                                    class="btn btn-info">Beri Ulasan</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal mt-5 fade" id="modalUlasan" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ulasan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('ulasan.store') }}" method="post">
                                                        @csrf
                                                        <input type="number" name="transaksi_id"
                                                            value="{{ $item->id }}" hidden>
                                                        <input type="number" name="detail_transaksi_id"
                                                            value="{{ $detail->id }}" hidden>
                                                        <input type="number" name="produk_id"
                                                            value="{{ $detail->produk_id }}" hidden>
                                                        <div class="modal-body">
                                                            <label class='mb-2' for='nilai'>Nilai</label>
                                                            <div class='form-group ml-4 mb-3'>
                                                                <br>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai" id="nilai1" value="1">
                                                                    <label class="form-check-label" for="nilai1">
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai" id="2" value="2">
                                                                    <label class="form-check-label" for="2">
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai" id="3" value="3">
                                                                    <label class="form-check-label" for="3">
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai" id="4" value="4">
                                                                    <label class="form-check-label" for="4">
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="nilai" id="5" value="5">
                                                                    <label class="form-check-label" for="5">
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                        <i class="fas fa-star"></i>
                                                                    </label>
                                                                </div>
                                                                @error('nilai')
                                                                    <div class='invalid-feedback d-inline'>
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                            <div class='form-group mb-3'>
                                                                <label for='ulasan' class='mb-2'>Ulasan</label>
                                                                <textarea name='ulasan' id='ulasan' cols='30' rows='3'
                                                                    class='form-control @error('ulasan') is-invalid @enderror'>{{ old('ulasan') }}</textarea>
                                                                @error('ulasan')
                                                                    <div class='invalid-feedback'>
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade mt-5" id="uploadBuktiPembayaran" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('transaksi.upload-bukti', $item->uuid) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class='form-group mb-3'>
                            <label for='bukti_pembayaran' class='mb-2'>Bukti Pembayaran
                                <small>(PNG,JPG,JEPG)</small></label>
                            <input type='file' name='bukti_pembayaran'
                                class='form-control @error('bukti_pembayaran') is-invalid @enderror'
                                value='{{ old('bukti_pembayaran') }}'>
                            @error('bukti_pembayaran')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
