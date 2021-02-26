@extends('layouts.app')

@section('title')
    Detail Pesanan - dipass-B2C
@endsection

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}"> 
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>   
@endpush

@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Detail Pesanan</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{ route('home') }}">HOME</a></li>
            <li><a href="{{ url('/checkout/') }}/{{ $order->schedule_id}}">Pemesanan Tiket Bus</a></li>
            <li class="active">Detail Pesanan</li>
        </ul>
    </div>
</div>
<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sm-8 col-md-9">
                <div class="booking-information travelo-box">
                    <h2>Konfirmasi Pembayaran Pemesanan</h2>
                    <hr />
                    <div class="booking-confirmation clearfix">
                        <i class="soap-icon-message icon circle"></i>
                        <div class="message">
                            <h4 class="main-message">Pesananmu telah terdaftar.</h4>
                            <p>Silakan untuk melanjutkan ke metode pembayaran</p>
                        </div>
                        {{-- <a href="#" class="print-button button btn-small">PRINT DETAILS</a> --}}
                    </div>
                    <hr />
                    <h2>Informasi Pesanan</h2>
                    <dl class="term-description">
                        <dt>Booking number:</dt><dd>{{ $order->order_no }}</dd>
                        <dt>Nama Penumpang:</dt><dd>{{ $order->passengers[0]->name }}</dd>
                        <dt>NIK:</dt><dd>{{ $order->passengers[0]->nik }}</dd>
                        <dt>Usia:</dt><dd>{{ $order->passengers[0]->age }}, ({{ $order->passengers[0]->gender }})</dd>
                        <dt>Kursi:</dt><dd>{{ $order->passengers[0]->seat_number }}</dd>
                        <dt>Berangkat:</dt><dd>{{ $order->departurePoint->point_name }}, {{ $order->departureCity->city_name }} <br>{{ $order->departure_date }}, {{ $order->departure_time }}</dd>
                        <dt>Tiba:</dt><dd>{{ $order->arrivalPoint->point_name }}, {{ $order->arrivalCity->city_name }} <br>{{ $order->arrival_date }}, {{ $order->arrival_time }}</dd>
                        <dt>Total Harga:</dt><dd><h3 class="text-success">Rp. {{ number_format($order->total_price) }}</h3></dd>
                    </dl>
                    <hr />
                    <h2>Pembayaran</h2>
                    <p>Pembayaran menggunakan dipass B2C bisa melalui berbagai macam cara pembayaran.</p>
                    <p class="red-color">Maaf Untuk saat ini pembayaran hanya bisa menggunakan transfer, sertakan bukti Transfer anda di bawah ini.</p> 
                    <div class="image-box style12">
                        <article class="box">
                            <figure>
                                <img src="{{ asset('/images/bank-dki.png') }}" alt="" class="middle-item" />
                            </figure>
                            <div class="details">
                                <h4 class="box-title">Bank DKI Jakarta</h4>
                                <p>021 546 546 765 <br>Dipass </p>
                            </div>
                        </article> 
                    </div>
                    <form action="{{ route('payment-process', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <button
                          type="submit"
                          class="btn btn-success btn-small full-width"
                        >
                        Konfirmasi Pembayaran
                        </button>
                      </form>
                </div>
            </div>
            <div class="sidebar col-sm-4 col-md-3">
                <div class="travelo-box contact-box">
                    <h4>Butuh Bantuan kami?</h4>
                    <p>Untuk respon yang lebih cepat, sampaikan pertanyaan atau permintaan Anda melalui Nomor Telpon ini.</p>
                    <address class="contact-details">
                        <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123</span>
                        <br>
                        <p>help@dipass.com</p>
                    </address>
                </div>
                {{-- <div class="travelo-box book-with-us-box">
                    <h4>Why Book with us?</h4>
                    <ul>
                        <li>
                            <i class="soap-icon-hotel-1 circle"></i>
                            <h5 class="title"><a href="#">135,00+ Hotels</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                            <i class="soap-icon-savings circle"></i>
                            <h5 class="title"><a href="#">Low Rates &amp; Savings</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                        <li>
                            <i class="soap-icon-support circle"></i>
                            <h5 class="title"><a href="#">Excellent Support</a></h5>
                            <p>Nunc cursus libero pur congue arut nimspnty.</p>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
{{-- calendar --}}
<script type="text/javascript" src="{{ asset('/js/calendar.js') }}"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
    
@endpush