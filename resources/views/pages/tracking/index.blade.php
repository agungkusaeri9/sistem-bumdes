@extends('layouts.app')
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92"
        style="background-image: url('{{ asset('assets/frontend') }}/images/bg-01.jpg');">
        <h2 class="ltext-105 cl0 txt-center">
            Tracking
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            <div class="row p-b-148">
                <div class="col-md-12">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-warning mb-3">Kembali</a>
                    <h2 class="mb-3">Tracking Summary</h2>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">AWB: {{ $data['summary']['awb'] }} - {{ $data['summary']['courier'] }}
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">Status: {{ $data['summary']['status'] }}</h6>
                            <p class="card-text">Service: {{ $data['summary']['service'] }}, Date:
                                {{ $data['summary']['date'] }}
                                Amount: {{ $data['summary']['amount'] }},
                                Weight: {{ $data['summary']['weight'] }}</p>
                            <p class="card-text">Origin: {{ $data['detail']['origin'] }} - Destination:
                                {{ $data['detail']['destination'] }}</p>
                            <p class="card-text">Shipper: {{ $data['detail']['shipper'] }} - Receiver:
                                {{ $data['detail']['receiver'] }}</p>
                        </div>
                    </div>
                    <h2 class="mt-4 mb-3">Tracking History</h2>
                    <ul class="list-group">
                        @foreach ($data['history'] as $history)
                            <li class="list-group-item">{{ $history['date'] }} - {{ $history['desc'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
