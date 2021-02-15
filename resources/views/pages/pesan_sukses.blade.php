@extends('layouts.app')

@section('title')
    Pesanan Sukses - dipass-B2C
@endsection

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/animate.min.css">
@endpush

@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Terima Kasih</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{ route('home') }}">HOME</a></li>
            <li><a href="{{ route('bus-pesan') }}">Pemesanan Tiket Bus</a></li>
            <li class="active">Terima Kasih</li>
        </ul>
    </div>
</div>
<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sm-8 col-md-9">
                <div class="booking-information travelo-box">
                    <h2>Konfirmasi Pemesanan</h2>
                    <hr />
                    <div class="booking-confirmation clearfix">
                        <i class="soap-icon-recommend icon circle"></i>
                        <div class="message">
                            <h4 class="main-message">Terima Kasih. Pesananmu telah dikonfirmasi.</h4>
                            <p>Pesanan konfirmasi telah dikirim ke email.</p>
                        </div>
                        <a href="#" class="print-button button btn-small">PRINT DETAILS</a>
                    </div>
                    <hr />
                    <h2>Informasi Pesanan</h2>
                    <dl class="term-description">
                        <dt>Booking number:</dt><dd>5784-BD245</dd>
                        <dt>Nama Depan:</dt><dd>Dini</dd>
                        <dt>Nama Belakang:</dt><dd>Juli</dd>
                        <dt>Alamat Email:</dt><dd>Info@dini.com</dd>
                        <dt>Alamat:</dt><dd>Jl.cahaya titis</dd>
                        <dt>Kota / Provinsi:</dt><dd>Depok, Jawa Barat</dd>
                        <dt>Kode Pos:</dt><dd>085695667157</dd>
                        <dt>Negara:</dt><dd>Indonesia</dd>
                    </dl>
                    <hr />
                    <h2>Pembayaran</h2>
                    <p>Pembayaran menggunakan dipass-B2C bisa melalui berbagai macam cara pembayaran.</p>
                    <br />
                    <p class="red-color">Payment is made by Credit Card Via Paypal.</p>
                    <hr />
                    <h2>Lihat Detail Pemesanan</h2>
                    <p>Praesent dolor lectus, rutrum sit amet risus vitae, imperdiet cursus neque. Nulla tempor nec lorem eu suscipit. Donec dignissim lectus a nunc molestie consectetur. Nulla eu urna in nisi adipiscing placerat. Nam vel scelerisque magna. Donec justo urna, posuere ut dictum quis.</p>
                    <br />
                    <a href="#" class="red-color underline view-link">https://www.travelo.com/booking-details/?=f4acb19f-9542-4a5c-b8ee</a>
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
<script type="text/javascript" src="/js/calendar.js"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="/components/flexslider/jquery.flexslider-min.js"></script>
    
@endpush