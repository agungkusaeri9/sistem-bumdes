@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Jenis</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Jenis</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <div class="card">
                            <div class="card-header">
                                <h5>Detail Produk</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-inline">
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Nama Produk</span>
                                        <span class="font-weight-bold">{{ $produk->nama }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Jenis</span>
                                        <span class="font-weight-bold">{{ $produk->jenis->nama }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Satuan</span>
                                        <span class="font-weight-bold">{{ $produk->satuan->nama }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Stok</span>
                                        <span class="font-weight-bold">{{ $produk->stok }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Terjual</span>
                                        <span class="font-weight-bold">{{ $produk->terjual }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Harga</span>
                                        <span class="font-weight-bold">{{ format_rupiah($produk->harga) }}</span>
                                    </li>
                                    <li class="list-inline-item mb-3 d-flex justify-content-between">
                                        <span>Aksi</span>
                                        <div>
                                            <a href="{{ route('admin.produk.index') }}" class="btn btn-warning">Kembali</a>
                                            <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                                class="btn btn-info">Edit</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5>Galeri Produk</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="javascript:void(0)" class="mb-3 btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambah">Tambah Data</a>
                                <div class="table-responsive">
                                    <table class="table nowrap table-bordered table-hover" id="dTable">
                                        <thead>
                                            <tr>
                                                <th width="10">No.</th>
                                                <th>Gambar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                    <td class="align-middle">
                                                        <img src="{{ $item->gambar() }}" class="img-fluid"
                                                            style="max-height:80px" alt="">
                                                    </td>
                                                    <td class="align-middle">
                                                        <form action="" method="post" class="d-inline"
                                                            id="formDelete">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                data-action="{{ route('admin.galeri-produk.destroy', $item->id) }}"
                                                                class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fas fa-trash"></i> Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.galeri-produk.store', $produk->id) }}" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class='form-group mb-3'>
                            <label for='gambar' class='mb-2'>Gambar</label>
                            <input type='file' name='gambar' class='form-control @error('gambar') is-invalid @enderror'
                                value='{{ old('gambar') }}'>
                            @error('gambar')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
