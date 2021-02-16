@extends('layouts.app')

@section('title')
    Pemesanan Bus - dipass-B2C
@endsection

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
@endpush

@section('content')
    <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Pemesanan Tiket Bus</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li class="active">Pemesanan Tiket Bus</li>
                </ul>
            </div>
        </div>
        <section id="content" class="gray-area">
            <div class="container">
                <div class="row">
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            
                            <form class="booking-form">
                                <div class="person-information">
                                    <h2>Informasi Data Diri</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Nama Depan</label>
                                            <input type="text" class="input-text full-width" value="Julian" placeholder="masukan nama Depan" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Nama Belakang</label>
                                            <input type="text" class="input-text full-width" value="Dini" placeholder="masukan Nama belakang" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Alamat Email</label>
                                            <input type="email" class="input-text full-width" value="dini@gmail.com" placeholder="masukan email anda" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>konfirmasi Alamat Email</label>
                                            <input type="text" class="input-text full-width" value="dini@gmail.com" placeholder="konfirmasi kembali email anda" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Nomor Telpon</label>
                                            <input type="number" class="input-text full-width" value="085696634334" placeholder="masukan nomor telpon anda" />
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group row">
                                    <div class="col-sm-6 col-md-5">
                                        <a href="{{ route('pesan-sukses') }}" type="submit" class="btn btn-success full-width btn-large">KONFIRMASI PESANAN</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Detail Pemesanan</h4>
                            <article class="flight-booking-details">
                                <figure class="clearfix">
                                    <a title="" href="flight-detailed.html" class="middle-block"><img class="middle-item" alt="" src="/images/list1.png""></a>
                                    <div class="travel-title">
                                        <h5 class="box-title">Ngawi ke Solo<small>satu Perjalanan</small></h5>
                                        <a href="flight-detailed.html" class="button">UBAH</a>
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="constant-column-3 timing clearfix">
                                        <div class="check-in">
                                            <label>Berangkat</label>
                                            <span>Rabu 27 Feb<br />7:50 am</span>
                                        </div>
                                        <div class="duration text-center">
                                            <i class="soap-icon-clock"></i>
                                            <span>3h, 40m</span>
                                        </div>
                                        <div class="check-out">
                                            <label>Tiba</label>
                                            <span>Rabu 27 Feb<br />9:20 am</span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            
                            <h4>Other Details</h4>
                            <dl class="other-details">
                                <dt class="feature">Nama Bus:</dt><dd class="value">Budiman</dd>
                                <dt class="feature">Tipe Bus:</dt><dd class="value">Ekonomi</dd>
                                {{-- <dt class="feature">base fare:</dt><dd class="value">$320</dd> --}}
                                {{-- <dt class="feature">taxes and fees:</dt><dd class="value">$300</dd> --}}
                                <dt class="total-price">Total Harga</dt><dd class="total-price-value">Rp. 309.000</dd>
                            </dl>
                        </div>
                        
                        <div class="travelo-box contact-box">
                            <h4>Butuh Bantuan kami?</h4>
                            <p>Untuk respon yang lebih cepat, sampaikan pertanyaan atau permintaan Anda melalui Nomor Telpon ini.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123-HELLO</span>
                                <br>
                                <a class="contact-email" href="#">help@dipass.com</a>
                            </address>
                        </div>
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