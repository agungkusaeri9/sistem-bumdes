@extends('layouts.app')
@section('content')
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140" style="margin-top: 120px">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <a class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="*"
                        href="{{ route('produk.index') }}">
                        Semua Produk
                    </a>

                    @foreach ($data_jenis as $jenis)
                        <a href="{{ route('produk.jenis', \Str::slug($jenis->nama)) }}"
                            class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter=".women">
                            {{ $jenis->nama }}
                        </a>
                    @endforeach
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <form action="{{ route('produk.index') }}">
                        <div class="bor8 dis-flex p-l-15">
                            <button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                                <i class="zmdi zmdi-search"></i>
                            </button>

                            <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="keyword"
                                placeholder="Search">
                        </div>
                    </form>
                </div>

            </div>

            <div class="row isotope-grid">
                @forelse ($items as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ $item->gambar() }}" alt="IMG-PRODUCT">

                                <a href="{{ route('produk.show', $item->slug) }}"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Lihat Detail
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('produk.show', $item->slug) }}"
                                        class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $item->nama }}
                                    </a>

                                    <span class="stext-105 cl3">
                                        {{ format_rupiah($item->harga) }}
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <p class="text-center">Tidak Ada Produk!</p>
                    </div>
                @endforelse
            </div>

            {{ $items->links('pagination::simple-bootstrap-4') }}

        </div>
    </div>
@endsection
