@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Pengurus</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.pengurus.index') }}">Pengurus</a></li>
                            <li class="breadcrumb-item">Edit Pengurus</li>
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
                                <form action="{{ route('admin.pengurus.update', $item->id) }}" method="post"
                                    class="needs-validation" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            required="" name="nama" value="{{ $item->nama ?? old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='jabatan_id'>Jabatan</label>
                                        <select name='jabatan_id' id='jabatan_id'
                                            class='form-control @error('jabatan_id') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Jabatan</option>
                                            @foreach ($data_jabatan as $jabatan)
                                                <option @selected($jabatan->id == $item->jabatan_id) value='{{ $jabatan->id }}'>
                                                    {{ $jabatan->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('jabatan_id')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group'>
                                        <label for='jenis_kelamin'>Jenis Kelamin</label>
                                        <select name='jenis_kelamin' id='jenis_kelamin'
                                            class='form-control @error('jenis_kelamin') is-invalid @enderror'>
                                            <option value='' selected disabled>Pilih Jenis Kelamin</option>
                                            <option @selected($item->jenis_kelamin === 'Laki-laki') value="Laki-laki">Laki-laki</option>
                                            <option @selected($item->jenis_kelamin === 'Perempuan') value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='tempat_lahir' class='mb-2'>Tempat Lahir</label>
                                        <input type='text' name='tempat_lahir'
                                            class='form-control @error('tempat_lahir') is-invalid @enderror'
                                            value='{{ $item->tempat_lahir ?? old('tempat_lahir') }}'>
                                        @error('tempat_lahir')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='tanggal_lahir' class='mb-2'>Tanggal Lahir</label>
                                        <input type='date' name='tanggal_lahir'
                                            class='form-control @error('tanggal_lahir') is-invalid @enderror'
                                            value='{{ $item->tanggal_lahir ? format_tanggal($item->tanggal_lahir, 'Y-m-d') : old('tanggal_lahir') }}'>
                                        @error('tanggal_lahir')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='nomor_hp' class='mb-2'>Nomor HP</label>
                                        <input type='text' name='nomor_hp'
                                            class='form-control @error('nomor_hp') is-invalid @enderror'
                                            value='{{ $item->nomor_hp ?? old('nomor_hp') }}'>
                                        @error('nomor_hp')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='mulai_jabatan' class='mb-2'>Mulai Jabatan</label>
                                        <input type='date' name='mulai_jabatan'
                                            class='form-control @error('mulai_jabatan') is-invalid @enderror'
                                            value='{{ format_tanggal($item->mulai_jabatan, 'Y-m-d') ?? old('mulai_jabatan') }}'>
                                        @error('mulai_jabatan')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='akhir_jabatan' class='mb-2'>Akhir Jabatan</label>
                                        <input type='date' name='akhir_jabatan'
                                            class='form-control @error('akhir_jabatan') is-invalid @enderror'
                                            value='{{ format_tanggal($item->akhir_jabatan, 'Y-m-d') ?? old('akhir_jabatan') }}'>
                                        @error('akhir_jabatan')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class='form-group mb-3'>
                                        <label for='gambar' class='mb-2'>Gambar</label>
                                        <input type='file' name='gambar'
                                            class='form-control @error('gambar') is-invalid @enderror'
                                            value='{{ $item->nama ?? old('gambar') }}'>
                                        @error('gambar')
                                            <div class='invalid-feedback'>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button class="btn float-right btn-primary">Update Data</button>
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
