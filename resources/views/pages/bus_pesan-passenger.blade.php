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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <form class="booking-form" 
                                {{-- id="wizard-validation-form"  --}}
                                action="{{ route('checkout_process', $schedule->id) }}" method="POST">
                                    @csrf
                                <div class="blog-infinite">
                                    <div class="post">
                                        <div class="post-content-wrapper">
                                            <div class="details">
                                                <div class="post-meta">
                                                    <div class="entry-author fn">
                                                        <i class="icon soap-icon-user"></i> Nama
                                                        <a href="#" class="author">Jessica Browen</a>
                                                    </div>
                                                    <div class="entry-action">
                                                        <a href="#" class="button entry-comment btn-small"><i class="soap-icon-comment"></i><span>NIK:865697643</span></a>
                                                        <a href="#" class="button btn-small"><i class="soap-icon-wishlist"></i><span>Laki-laki</span></a>
                                                        <span class="entry-tags"><i class="soap-icon-features"></i><span><a href="#">22</a><a href="#">th</a></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="post-meta">
                                                    <div class="entry-author fn">
                                                        <i class="icon soap-icon-user"></i> Nama
                                                        <a href="#" class="author">Jessica Browen</a>
                                                    </div>
                                                    <div class="entry-action">
                                                        <a href="#" class="button entry-comment btn-small"><i class="soap-icon-comment"></i><span>NIK:865697643</span></a>
                                                        <a href="#" class="button btn-small"><i class="soap-icon-wishlist"></i><span>Laki-laki</span></a>
                                                        <span class="entry-tags"><i class="soap-icon-features"></i><span><a href="#">22</a><a href="#">th</a></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="details">
                                                <div class="post-meta">
                                                    <div class="entry-author fn">
                                                        <i class="icon soap-icon-user"></i> Nama
                                                        <a href="#" class="author">Jessica Browen</a>
                                                    </div>
                                                    <div class="entry-action">
                                                        <a href="#" class="button entry-comment btn-small"><i class="soap-icon-comment"></i><span>NIK:865697643</span></a>
                                                        <a href="#" class="button btn-small"><i class="soap-icon-wishlist"></i><span>Laki-laki</span></a>
                                                        <span class="entry-tags"><i class="soap-icon-features"></i><span><a href="#">22</a><a href="#">th</a></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <h3 class="">Data Penumpang</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name2">Nama</label>
                                                    <small>Isilah sesuai nama KTP penumpang</small>
                                                        <input id="passenger_name" name="passenger_name" type="text" class="required form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="surname2">NIK</label>
                                                    <small>Isilah dengan NIK pada KTP Penumpang </small>
                                                        <input id="passenger_nik" name="passenger_nik" type="text" class="required form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="email2">umur</label>
                                                    <input id="passenger_age" name="passenger_age" type="number" class="required form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="address2">Jenis Kelamin </label>
                                                    <div class="selector">
                                                        <select name="passenger_gender" class="full-width">
                                                            <option value="Male">Laki-Laki</option>
                                                            <option value="Female">Perempuan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="seat">Kursi</label>
                                            <small>*Pilihlah kursi berdasarkan penumpang</small> <br>
                                            @foreach ($schedule->route->bus->layout['component'] as $key => $val)
                                            @if($val['type'] === 'seat')
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input @error('passenger_seat_number') is-invalid @enderror" type="radio" name="passenger_seat_number" id="inlineRadio2" value="{{ $val['seat_number'] }}">
                                                <label class="form-check-label" for="inlineRadio2">{{ $val['seat_number'] }}</label>
                                            </div>
                                            @else 
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="hidden" name="inlineRadioOptions" id="inlineRadio3" value="{{ $val['type'] }}" disabled>
                                                <label class="form-check-label" for="inlineRadio3">{{ $val['type'] }}</label>
                                            </div>
                                            @endif
                                            @endforeach 
                                        </div>
                                    </section>
                                    <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">
                                        Tambah Penumpang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-sms-6 col-sm-4 col-md-4 col-lg-3">
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
    <script src="{{ asset('/assets/plugins/jquery.steps/js/jquery.steps.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('/assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <!--wizard initialization-->
    <script src="{{ asset('/assets/plugins/jquery.steps/js/jquery.wizard-init.js') }}" type="text/javascript"></script>

@endpush