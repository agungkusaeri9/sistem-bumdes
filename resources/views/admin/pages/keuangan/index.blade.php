@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Keuangan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Keuangan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.keuangan.print') }}" method="post">
                                    @csrf
                                    <div class='form-group'>
                                        <label for='bulan'>Bulan</label>
                                        <select name='bulan' id='bulan'
                                            class='form-control @error('bulan') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Bulan</option>
                                            <option value='1'>Januari</option>
                                            <option value='2'>Februari</option>
                                            <option value='3'>Maret</option>
                                            <option value='4'>April</option>
                                            <option value='5'>Mei</option>
                                            <option value='6'>Juni</option>
                                            <option value='7'>Juli</option>
                                            <option value='8'>Agustus</option>
                                            <option value='9'>September</option>
                                            <option value='10'>Oktober</option>
                                            <option value='11'>November</option>
                                            <option value='12'>Desember</option>
                                        </select>
                                        @error('bulan')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='tahun'>Tahun</label>
                                        <select name='tahun' id='tahun'
                                            class='form-control @error('tahun') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Tahun</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                        </select>
                                        @error('tahun')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-danger">Print</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <a href="{{ route('admin.keuangan.create') }}" class="btn btn-sm btn-primary mb-3">Tambah
                                    Data</a>
                                <div class="table-responsive">
                                    <table class="table nowrap table-bordered table-hover" id="dTable">
                                        <thead>
                                            <tr>
                                                <th width="10">No.</th>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                                <th>Nominal</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->created_at->translatedFormat('d F Y H:i:s') }}</td>
                                                    <td>{{ $item->jenis }}</td>
                                                    <td>{{ format_rupiah($item->nominal) }}</td>
                                                    <td>{{ $item->keterangan }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.keuangan.edit', $item->id) }}"
                                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                        <form action="" method="post" class="d-inline"
                                                            id="formDelete">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                data-action="{{ route('admin.keuangan.destroy', $item->id) }}"
                                                                class="btn btn-sm btn-danger btnDelete"><i
                                                                    class="fas fa-trash"></i> Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-left" colspan="4">Pemasukan</th>
                                                <td colspan="2">
                                                    {{ $items ? format_rupiah($items->where('jenis', 'pemasukan')->sum('nominal')) : 'Rp 0' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left" colspan="4">Pengeluaran</th>
                                                <td colspan="2">
                                                    {{ $items ? format_rupiah($items->where('jenis', 'pengeluaran')->sum('nominal')) : 'Rp 0' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left" colspan="4">Laba</th>
                                                <td colspan="2">
                                                    {{ $items ? format_rupiah($items->where('jenis', 'pemasukan')->sum('nominal') - $items->where('jenis', 'pengeluaran')->sum('nominal')) : 'Rp 0' }}
                                                </td>
                                            </tr>
                                        </tfoot>
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
