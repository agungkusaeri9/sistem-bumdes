@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}">Produk</a></li>
                            <li class="breadcrumb-item">Tambah Produk</li>
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
                                <form action="{{ route('admin.produk.store') }}" method="post" class="needs-validation"
                                    novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            required="" name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='jenis_id'>Jenis</label>
                                        <select name='jenis_id' id='jenis_id'
                                            class='form-control @error('jenis_id') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Jenis</option>
                                            @foreach ($data_jenis as $jenis)
                                                <option @selected($jenis->id == old('jenis_id')) value='{{ $jenis->id }}'>
                                                    {{ $jenis->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='satuan_id'>Satuan</label>
                                        <select name='satuan_id' id='satuan_id'
                                            class='form-control @error('satuan_id') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Satuan</option>
                                            @foreach ($data_satuan as $satuan)
                                                <option @selected($satuan->id == old('satuan_id')) value='{{ $satuan->id }}'>
                                                    {{ $satuan->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_id')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='stok' class='mb-2'>Stok</label>
                                        <input type='number' name='stok'
                                            class='form-control @error('stok') is-invalid @enderror'
                                            value='{{ old('stok') }}'>
                                        @error('stok')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='harga' class='mb-2'>Harga</label>
                                        <input type='number' name='harga'
                                            class='form-control @error('harga') is-invalid @enderror'
                                            value='{{ old('harga') }}'>
                                        @error('harga')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='deskripsi' class='mb-2'>Deskripsi</label>
                                        <textarea name='deskripsi' id='deskripsi' cols='30' rows='3'
                                            class='form-control @error('deskripsi') is-invalid @enderror'>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='gambar' class='mb-2'>Gambar</label>
                                        <input type='file' name='gambar'
                                            class='form-control @error('gambar') is-invalid @enderror'
                                            value='{{ old('gambar') }}'>
                                        @error('gambar')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn float-right btn-primary">Tambah Data</button>
                                    </div>
                                </form>
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
