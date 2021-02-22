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
    <!--favicon-->
    <link rel="icon" href="{{ asset('/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- jquery steps CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/plugins/jquery.steps/css/jquery.steps.css') }}">
    <!-- simplebar CSS-->
    <link href="{{ asset('/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="{{ asset('/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{ asset('/assets/css/sidebar-menu.css') }}" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{ asset('/assets/css/app-style.css') }}" rel="stylesheet"/>
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
                    <div id="main" class="col-sms-6 col-sm-8 col-md-8 col-lg-9">
                        <div class="booking-section travelo-box">
                            
                            <form class="booking-form" id="wizard-validation-form" action="#">
                                <div>
                                    <h3>Data Diri</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="userName2">Nama</label>
                                            <input class="required form-control" id="name" name="name" type="text" value="dini">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">Email</label>
                                            <input id="email" name="email" type="email" class="required email form-control" value="dini@gmail.com">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="confirm2">Nomor Telpon</label>
                                            <input id="phone" name="phone" type="number" class="required form-control" value="0856564532">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-12 control-label"><span class="text-danger">(*)NOTE</span> <br> Nama : Isilah sesuai nama KTP <br> Email : Isilah dengan email anda yang aktif <br> Nomor Telepon: Isilah dengan nomor telpon anda yang aktif</label>
                                        </div>
                                    </section>
                                    <h3>Data Penumpang</h3>
                                    <section>
            
                                        <div class="form-group">
                                            <label for="name2">Nama</label>
                                                <input id="name" name="name" type="text" class="required form-control" value="dini">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname2">Umur</label>
                                                <input id="age" name="age" type="number" class="required form-control" value="21">
                                        </div>
            
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <div class="constant-column-2">
                                                <div class="selector">
                                                    <select class="full-width">
                                                        <option selected>Laki-Laki</option>
                                                        <option>Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label for="address2">NIK / Paspor</label>
                                            <input id="nik" name="nik" type="text" class="form-control" value="98876645678967">
                                        </div>
            
                                        <div class="form-group">
                                            <label class="col-lg-12 control-label">(*) Mandatory</label>
                                        </div>
                                    </section>
                                    <h3>Pickup & Drop Point</h3>
                                    <section>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <div class="checkbox">
                                                    <input type="checkbox" checked id="warning" class="required" />
                                                    <label for="warning">Terminal 1</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="checkbox">
                                                    <input type="checkbox" checked id="warning" class="required" />
                                                    <label for="warning">Terminal 2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Total</h3>
                                    <section>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-4 col-lg-3">
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

    <!--Form Wizard-->
    <script src="{{ asset('/assets/plugins/jquery.steps/js/jquery.steps.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!--wizard initialization-->
    <script src="{{ asset('/assets/plugins/jquery.steps/js/jquery.wizard-init.js') }}" type="text/javascript"></script>

@endpush