@extends('layouts.app')
@section('content')
    <!-- breadcrumb -->
    <div class="container" style="margin-top: 120px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Keranjang
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->

    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-6">Aksi</th>
                            </tr>
                            @php
                                $weight = 0;
                            @endphp
                            @foreach ($items as $item)
                                @php
                                    $weight = $weight + $item->produk->berat * $item->jumlah;
                                @endphp
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ $item->produk->gambar() }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-2">{{ $item->produk->nama }}</td>
                                    <td class="column-3">{{ format_rupiah($item->harga) }}</td>
                                    <td class="column-4">{{ $item->jumlah }}</td>
                                    <td class="column-5">{{ format_rupiah($item->total_harga) }}</td>
                                    <td>
                                        <form action="{{ route('keranjang.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                    <form class="bg0 p-t-75 p-b-85" action="{{ route('checkout') }}" method="post" id="formCheckout">
                        <div class="card mt-4">
                            <div class="card-body">
                                <h4 class="mb-4">Form Pemesanan</h4>
                                @csrf
                                <input type="number" name="weight" id="weight" value="{{ $weight }}" hidden>
                                <input type="number" name="total_bayar">
                                <div class='form-group mb-3'>
                                    <label for='nama' class='mb-2'>Nama</label>
                                    <input type='text' name='nama'
                                        class='form-control @error('nama') is-invalid @enderror'
                                        value='{{ auth()->user()->name ?? old('nama') }}'>
                                    @error('nama')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='nomor_hp' class='mb-2'>Nomor HP</label>
                                    <input type='text' name='nomor_hp'
                                        class='form-control @error('nomor_hp') is-invalid @enderror'
                                        value='{{ old('nomor_hp') }}'>
                                    @error('nomor_hp')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group'>
                                    <label for='provinsi_id'>Provinsi</label>
                                    <select name='provinsi_id' id='provinsi_id'
                                        class='form-control @error('provinsi_id') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Provinsi</option>
                                        @foreach ($data_provinsi as $provinsi)
                                            <option @selected($provinsi->id == old('provinsi_id')) value='{{ $provinsi->id }}'>
                                                {{ $provinsi->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('provinsi_id')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group'>
                                    <label for='kota_id'>Kota</label>
                                    <select name='kota_id' id='kota_id'
                                        class='form-control @error('kota_id') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Kota</option>
                                    </select>
                                    @error('kota_id')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group mb-3'>
                                    <label for='alamat' class='mb-2'>Alamat</label>
                                    <textarea name='alamat' id='alamat' cols='30' rows='3'
                                        class='form-control @error('alamat') is-invalid @enderror'>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group'>
                                    <label for='kurir'>Kurir</label>
                                    <select name='kurir' id='kurir'
                                        class='form-control @error('kurir') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Kurir</option>
                                        @foreach ($data_kurir as $kurir)
                                            <option @selected($kurir->id == old('kurir')) value='{{ $kurir->kode }}'>
                                                {{ $kurir->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('kurir')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group'>
                                    <label for='ongkos_kirim'>Jenis</label>
                                    <select name='ongkos_kirim' id='ongkos_kirim'
                                        class='form-control @error('ongkos_kirim') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Jenis</option>
                                    </select>
                                    @error('ongkos_kirim')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group'>
                                    <label for='jenis_pembayaran'>Jenis Pembayaran</label>
                                    <select name='jenis_pembayaran' id='jenis_pembayaran'
                                        class='form-control @error('jenis_pembayaran') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Jenis Pembayaran</option>
                                        <option value="manual">Manual</option>
                                        <option value="otomatis">Otomatis</option>
                                    </select>
                                    @error('jenis_pembayaran')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class='form-group display-metode-pembayaran d-none'>
                                    <label for='metode_pembayaran_id'>Metode Pembayaran</label>
                                    <select name='metode_pembayaran_id' id='metode_pembayaran_id'
                                        class='form-control @error('metode_pembayaran_id') is-invalid @enderror'>
                                        <option value='' selected disabled>Pilih Metode Pembayaran</option>
                                        @foreach ($data_metode_pembayaran as $metode_pembayaran)
                                            <option @selected($metode_pembayaran->id == old('metode_pembayaran_id')) value='{{ $metode_pembayaran->id }}'>
                                                {{ $metode_pembayaran->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('metode_pembayaran_id')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Total Keranjang
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                {{ $items ? format_rupiah($items->sum('total_harga')) : '0' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Ongkos Kirim:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                <div id="ongkir"></div>
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total Bayar:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                <div id="total_bayar"></div>
                            </span>
                        </div>
                    </div>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 btnCheckout">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {

            function formatRupiah(angka) {
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });

                return formatter.format(angka);
            }

            $('#provinsi_id').on('change', function() {
                let provinsi_id = $(this).val();
                $.ajax({
                    url: '{{ route('getKotaByProvinsiId') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        provinsi_id,
                    },
                    success: function(res) {
                        if (res.length > 0) {
                            $('#kota_id').empty();
                            $('#kota_id').append(
                                `<option selected disabled>Pilih Kota</option>`);
                            res.forEach(kota => {
                                $('#kota_id').append(
                                    `<option value="${kota.id}">${kota.name} </option>`
                                );
                            });
                        }
                    }
                })
            })

            $('#kurir').on('change', function() {
                let kurir_code = $(this).val();
                let kota_id = $('#kota_id').val();
                let weight = $('#weight').val();
                console.log(kota_id);
                $.ajax({
                    url: '{{ route('cek-ongkir') }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        courier: kurir_code,
                        destination: kota_id,
                        weight: weight
                    },
                    success: function(res) {
                        console.log(res.rajaongkir.results[0].costs);
                        let costs = res.rajaongkir.results[0].costs;
                        if (costs.length > 0) {
                            $('#ongkos_kirim').empty();
                            $('#ongkos_kirim').append(
                                `<option selected disabled>Pilih Jenis</option>`);
                            costs.forEach(cost => {
                                $('#ongkos_kirim').append(
                                    `<option value="${cost.cost[0].value}">${cost.service} ${cost.description} | ${cost.cost[0].value} Est: ${cost.cost[0].etd} </option>`
                                );
                            });
                        }
                    },
                    error: function(xhr, status, errorThrown) {
                        console.log("Error Status:", status);
                        console.log("Thrown Error:", errorThrown);
                        console.log("Response:", xhr.responseText);
                    }
                });

            })

            $('#ongkos_kirim').on('change', function() {
                let ongkir = $(this).val();
                $('#ongkir').html(formatRupiah(ongkir));

                let sub_total = '{{ $items->sum('total_harga') }}';
                // total bayar
                let total_bayar = parseInt(ongkir) + parseInt(sub_total);
                $('input[name=total_bayar]').val(total_bayar);

                $('#total_bayar').html(formatRupiah(total_bayar));

            })

            $('.btnCheckout').on('click', function() {
                $('#formCheckout').submit();
            })

            $('#jenis_pembayaran').on('change', function() {
                let jenis_pembayaran = $(this).val();
                if (jenis_pembayaran === 'manual') {
                    $('.display-metode-pembayaran').removeClass('d-none');
                } else {
                    $('.display-metode-pembayaran').addClass('d-none');
                }
            })
        })
    </script>
@endpush
