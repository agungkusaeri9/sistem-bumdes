@extends('layouts.app')
@section('content')
    <!-- breadcrumb -->
    <div class="container" style="margin-top: 120px">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('produk.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                {{ $item->jenis->nama }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $item->nama }}
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ $item->gambar() }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ $item->gambar() }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="{{ $item->gambar() }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                @foreach ($item->galeri as $galeri)
                                    <div class="item-slick3" data-thumb="{{ $galeri->gambar() }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ $galeri->gambar() }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ $galeri->gambar() }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $item->nama }}
                        </h4>

                        <span class="mtext-106 cl2">
                            {{ format_rupiah($item->harga) }}
                        </span>
                        <p class="small mt-2">
                            Stok : {{ $item->stok }}
                        </p>
                        <!--  -->
                        <div class="p-t-33">

                            <form action="{{ route('keranjang.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $item->id }}">
                                <div class='form-group mb-3'>
                                    <label for='keterangan' class='mb-2'>Keterangan</label>
                                    <textarea name='keterangan' id='keterangan' cols='30' rows='3'
                                        class='form-control @error('keterangan') is-invalid @enderror'>{{ old('keterangan') }}</textarea>
                                    @error('keterangan')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="jumlah" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Deskripsi</a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Ulasan
                                ({{ $item->ulasan->count() ?? '0' }})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $item->deskripsi }}
                                </p>
                            </div>
                        </div>


                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @foreach ($item->ulasan as $ulasan)
                                            <div class="flex-w flex-t p-b-68">
                                                <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                                    <img src="{{ asset('assets/frontend') }}/images/avatar-01.jpg"
                                                        alt="AVATAR">
                                                </div>

                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
                                                        <span class="mtext-107 cl2 p-r-20">
                                                            {{ $ulasan->user->name }}
                                                        </span>

                                                        <span class="fs-18 cl11">
                                                            @if ($ulasan->nilai == 1)
                                                                <i class="zmdi zmdi-star"></i>
                                                            @elseif ($ulasan->nilai == 2)
                                                                <i class="zmdi zmdi-star"></i><i
                                                                    class="zmdi zmdi-star"></i>
                                                            @elseif ($ulasan->nilai == 3)
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                            @elseif ($ulasan->nilai == 4)
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                            @else
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                                <i class="zmdi zmdi-star"></i>
                                                            @endif
                                                        </span>
                                                    </div>

                                                    <p class="stext-102 cl6">
                                                        {{ $ulasan->ulasan }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
