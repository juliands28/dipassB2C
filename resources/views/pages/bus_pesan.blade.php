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
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            
                            <form class="booking-form" id="wizard-validation-form" action="{{ route('order', $schedule->id) }}">
                                <div>
                                    <h3>Step 1</h3>
                                    <section>
                                        <div class="form-group">
                                            <label for="userName2">Nama</label>
                                            <input class="required form-control" id="name" name="name" type="text" value="dini">
                                        </div>
                                        <div class="form-group">
                                            <label for="password2">phone</label>
                                            <input id="phone" name="phone" type="text" class="required form-control" value="06442353464">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="confirm2">Email</label>
                                            <input id="email" name="email" type="email" class=" email required form-control" value="dini@gmail.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-12 control-label">(*) Mandatory</label>
                                        </div>
                                    </section>
                                    <h3>Step 2</h3>
                                    <section>
            
                                        <div class="form-group">
                                            <label for="name2">Nama</label>
                                                <input id="passenger_name" name="passenger_name" type="text" class="required form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="surname2">NIK</label>
                                                <input id="passenger_nik" name="passenger_nik" type="text" class="required form-control">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="email2">Umur</label>
                                            <input id="passenger_age" name="passenger_age" type="number" class="required form-control">
                                        </div>
            
                                        <div class="form-group">
                                            <label for="address2">Jenis Kelamin </label>
                                            <div class="selector">
                                                <select name="passenger_gender" class="full-width">
                                                    <option>Laki-Laki</option>
                                                    <option>Perempuan</option>
                                                </select>
                                            </div>
                                            {{-- <input id="passenger_gender"  type="text" class="form-control"> --}}
                                        </div>
            
                                        <div class="form-group">
                                            <label class="col-lg-12 control-label">(*) Mandatory</label>
                                        </div>
                                    </section>
                                    <h3>Step 3</h3>
                                    <section>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <ul class="list-unstyled w-list">
                                                    <li>First Name : Jonathan </li>
                                                    <li>Last Name : Smith </li>
                                                    <li>Emial: jonathan@example.com</li>
                                                    <li>Address: 123 Your City, Cityname. </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </section>
                                    <h3>Step Final</h3>
                                    <section>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <input id="acceptTerms-2" name="acceptTerms2" type="checkbox" class="required">
                                                <label for="acceptTerms-2">Dengan memilih Lanjut ke Pembayaran, Anda menyetujui Syarat & Ketentuan serta Kebijakan Privasi DIPASS Provider.</label>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <p>
                                        @php $totalPrice = 0 @endphp
                                        <input type="hidden" name="route_id" id="route_id" value="{{ $schedule->route->route_id }}">
                                        <input type="hidden" name="schedule_id" id="schedule_id" value="{{ $schedule->id }}">
                                        <input type="hidden" name="departure_city" id="departure_city" value="{{ $schedule->route->departure_id }}">
                                        <input type="hidden" name="departure_point" id="departure_point" value="{{$schedule->route->points->first()->point_id}}">
                                        <input type="hidden" name="departure_date" id="departure_date" value="{{ $schedule->date->format('d/m/Y') }}">
                                        <input type="hidden" name="departure_time" id="departure_time" value="{{ $schedule->route->board_points->first()->time }}">
                                        <input type="hidden" name="arrival_city" id="arrival_city" value="{{ $schedule->route->arrival_id }}">
                                        <input type="hidden" name="arrival_point" id="arrival_point" value="{{ $schedule->route->points ->last()->point_id }}">
                                        <input type="hidden" name="arrival_date" id="arrival_date" value="{{ $schedule->date->format('d/m/Y') }}">
                                        <input type="hidden" name="arrival_time" id="arrival_time" value="{{ $schedule->route->board_points->last()->time }}">
                                        @php $totalPrice += $schedule->price @endphp
                                        <input type="hidden" name="total_price" id="total_price" value="{{ $schedule->price }}">                                        
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Detail Pemesanan</h4>
                            <article class="flight-booking-details">
                                <figure class="clearfix">
                                    <a title="" href="flight-detailed.html" class="middle-block"><img class="middle-schedule" alt="" src="/images/list1.png""></a>
                                    <div class="travel-title">
                                        <h5 class="box-title">{{ $schedule->route->title }}<small>satu Perjalanan</small></h5>
                                        {{-- <a href="flight-detailed.html" class="button">UBAH</a> --}}
                                    </div>
                                </figure>
                                <div class="details">
                                    <div class="constant-column-3 timing clearfix">
                                        <div class="check-in">
                                            <label>Berangkat</label>
                                            <span>{{ $schedule->route->points->first()->point_name }} <br><br />{{ $schedule->date->format('d/m/Y') }} <br>{{ $schedule->route->board_points->first()->time }} - hari ke {{ $schedule->route->board_points->first()->day }} </span>
                                        </div>
                                        <div class="duration text-center">
                                            <i class="soap-icon-clock"></i>
                                            <span>3h, 40m</span>
                                        </div>
                                        <div class="check-out">
                                            <label>Tiba</label>
                                            <span>{{ $schedule->route->points ->last()->point_name }} <br><br />{{ $schedule->date->format('d/m/Y') }} <br>{{ $schedule->route->board_points->last()->time }} - hari ke {{ $schedule->route->board_points->last()->day }} </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            
                            <h4>Other Details</h4>
                            <dl class="other-details">
                                <dt class="feature">Nama Bus:</dt><dd class="value">{{ $schedule->route->bus->bus_name }}</dd>
                                <dt class="feature">kelas/Tipe Bus:</dt><dd class="value">{{ $schedule->route->bus->class->class_name }} / {{ $schedule->route->bus->category->category_name }}</dd>
                                <dt class="feature">Nomor Bus:</dt><dd class="value">{{ $schedule->bus_number }}</dd>
                                <dt class="feature">Fasilitas dalam Bus:</dt><dd class="value">
                                    @foreach ($schedule->route->bus->facilities as $fasilitas)
                                    {{ $fasilitas->facility_name }},
                                    @endforeach
                                </dd>
                                <dt class="total-price">Total Harga</dt><dd class="total-price-value">Rp. {{ number_format($schedule->price) }}</dd>
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