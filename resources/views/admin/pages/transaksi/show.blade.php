@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
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
                                            <th>Produk</th>
                                            <td>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga Awal</th>
                                                            <th>Harga Akhir</th>
                                                        </tr>
                                                        @foreach ($item->details as $detail)
                                                            <tr>
                                                                <td>{{ $detail->produk->nama }}</td>
                                                                <td>{{ $detail->jumlah }}</td>
                                                                <td>{{ number_format($detail->produk->harga) }}</td>
                                                                <td>{{ number_format($detail->total_harga) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Pembayaran</th>
                                            <td>
                                                @if (!$item->metode_pembayaran)
                                                    -
                                                @else
                                                    {{ $item->metode_pembayaran->nama . ' - ' . $item->metode_pembayaran->nomor_rekening . ' (' . $item->metode_pembayaran->atas_nama . ')' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Kurir</th>
                                            <td>{{ $item->kurir }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Resi</th>
                                            <td>{{ $item->nomor_resi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Ongkos Kirim</th>
                                            <td>Rp. {{ number_format($item->ongkos_kirim) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>Rp. {{ number_format($item->total_bayar) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Bukti Pembayaran</th>
                                            <td>
                                                @if ($item->bukti_pembayaran)
                                                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}"
                                                        target="_blank" class="btn btn-info btn-sm">Lihat</a>
                                                @else
                                                    Tidak Ada
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Waktu</th>
                                            <td>{{ $item->created_at->translatedFormat('d/m/Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                {!! $item->status() !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Aksi</th>
                                            <td>
                                                <a href="{{ route('admin.transaksi.index') }}"
                                                    class="btn btn-warning">Kembali</a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}">
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(function() {
            $('#dTable').DataTable();
            $('body').on('click', '.btnDelete', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah yakin?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let action = $(this).data('action');
                        $('#formDelete').attr('action', action);
                        $('#formDelete').submit();
                    }
                })
            })
        })
    </script>
    @include('admin.layouts.partials.sweetalert')
@endpush
