@extends('layouts.app')

@section('title')
    Bus List - dipass-B2C
@endsection

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
@endpush

@section('content')
    <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Daftar Pemesanan Bus</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>

        <section id="content" class="gray-area">
            <div class="container shortcode">
                <div class="block">
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <h2>Tabs 01</h2> --}}
                            <div class="tab-container box">
                                <ul class="tabs">
                                    <li class="active"><a href="#pending" data-toggle="tab">proses konfirmasi</a></li>
                                    <li><a href="#sukses" data-toggle="tab">selesai</a></li>
                                    {{-- <li><a href="#careers" data-toggle="tab">Careers</a></li> --}}
                                </ul>
                                <div class="tab-content tab-content1">
                                    <div class="tab-pane fade  in active" id="pending">
                                        <div class="col-lg-12 listing-style3 cruise">
                                            @forelse ($carts as $cart)
                                                <article class="box  p-3">
                                                    @if ($cart->status === 'Pending')
                                                        
                                                    @endif
                                                    <figure class="col-sm-4 col-md-4">
                                                        <a title="" href="{{ url('/view-bus/') }}/{{ $cart->schedule_id}}" class="hover-effect">
                                                            {{-- <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt=""> --}}
                                                            <img width="270" height="160" alt="" src="http://api-dipass-provider.test/file/bus/{{ $cart->route->bus->photo }}">
                                                        </a>
                                                    </figure>
                                                    <div class="details col-sm-8 col-md-8">
                                                        <div class="clearfix">
                                                            <h4 class="box-title pull-left">{{ $cart->route->title }}<small>{{ $cart->order_no }}</small></h4>
                                                            <span class="price pull-right"><small>Total</small>Rp. {{ number_format($cart->total_price) }}</span>
                                                        </div>
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-sm-3 col-6 col-md-4 cruise-logo">
                                                                    @if($cart->route->company->logo === null)
                                                                        {{ $cart->route->company->company_name }}
                                                                    @else
                                                                        <img width="20%" src="http://api-dipass-provider.test/file/logo/{{ $cart->route->company->logo }}" alt="logo company">
                                                                        {{ $cart->route->company->company_name }}
                                                                    @endif 
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-2 date">
                                                                    <i class="soap-icon-clock yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">Date</span><br>{{ $cart->date }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-3 departure">
                                                                    <i class="soap-icon-departure yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">berangkat</span><br>{{ $cart->departurePoint->point_name }}, {{ $cart->departureCity->city_name }} 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-3 departure">
                                                                    <i class="soap-icon-departure yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">Tiba</span><br>{{ $cart->arrivalPoint->point_name }}, {{ $cart->arrivalCity->city_name }} 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class=" pull-left">
                                                                <p>
                                                                    @if ($cart->status === 'Pending')
                                                                        <a class="button btn-small yellow">Sedang dikonfirmasi</a>
                                                                    @elseif ($cart->status === 'Success')
                                                                        <a class="button btn-small green">Pesanan selesai</a>
                                                                    @else
                                                                        <a class="button btn-small red">Pesanan Expired</a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            @if ($cart->status === 'Pending')
                                                                <a href="{{ url('/checkout/confirm/') }}/{{ $cart->id}}" class="button btn-small pull-right">Detail Order</a>
                                                            @else
                                                            <a href="{{ url('/sukses/') }}/{{ $cart->id}}" class="button btn-small pull-right">Detail Order</a>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            @empty
                                            <article class="box p-3">
                                                <img src="{{ asset('/images/nodata.png') }}" width="30%" class="rounded mx-auto d-block" alt="data tidak ditemukan">
                                                <div class="row mt-5">
                                                    <div class="col text-center">
                                                    <button class="btn btn-success btn-small">Home Page</button>
                                                    </div>
                                                </div>
                                            </article>                                            
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="sukses">
                                        <div class="col-lg-12 listing-style3 cruise">
                                            @forelse ($bookings as $booking)
                                                <article class="box p-3">
                                                    <figure class="col-sm-4 col-md-4">
                                                        <a title="" href="#" class="hover-effect">
                                                            {{-- <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt=""> --}}
                                                            <img width="270" height="160" alt="" src="http://api-dipass-provider.test/file/bus/{{ $booking->order->route->bus->photo }}">
                                                        </a>
                                                    </figure>
                                                    <div class="details col-sm-8 col-md-8">
                                                        <div class="clearfix">
                                                            <h4 class="box-title pull-left">{{ $booking->order->route->title }}<small>{{ $booking->order->order_no }}</small></h4>
                                                            <span class="price pull-right"><small>Total</small>Rp. {{ number_format($booking->order->total_price) }}</span>
                                                        </div>
                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-sm-3 col-6 col-md-4 cruise-logo">
                                                                    @if($booking->order->route->company->logo === null)
                                                                        {{ $booking->order->route->company->company_name }}
                                                                    @else
                                                                        <img width="20%" src="http://api-dipass-provider.test/file/logo/{{ $booking->order->route->company->logo }}" alt="logo company">
                                                                        {{ $booking->order->route->company->company_name }}
                                                                    @endif 
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-2 date">
                                                                    <i class="soap-icon-clock yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">Date</span><br>{{ $booking->order->date }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-3 departure">
                                                                    <i class="soap-icon-departure yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">berangkat</span><br>{{ $booking->order->departurePoint->point_name }}, {{ $booking->order->departureCity->city_name }} 
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 col-6 col-md-3 departure">
                                                                    <i class="soap-icon-departure yellow-color"></i>
                                                                    <div>
                                                                        <span class="skin-color">Tiba</span><br>{{ $booking->order->arrivalPoint->point_name }}, {{ $booking->order->arrivalCity->city_name }} 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">
                                                            <div class=" pull-left">
                                                                <p>
                                                                    @if ($booking->order->status === 'Pending')
                                                                        <a class="button btn-small yellow">Sedang dikonfirmasi</a>
                                                                    @elseif ($booking->order->status === 'Success')
                                                                        <a class="button btn-small green">Pesanan selesai</a>
                                                                    @else
                                                                        <a class="button btn-small red">Pesanan Expired</a>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            @if ($booking->order->status === 'Pending')
                                                                <a href="{{ url('/checkout/confirm/') }}/{{ $booking->order->id}}" class="button btn-small pull-right">Detail Order</a>
                                                            @else
                                                            <a href="{{ url('/manifest/') }}/{{ $booking->booking->id}}" class="button btn-small pull-right">Detail Mainfest</a>
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </article>
                                            @empty
                                            <img src="{{ asset('/images/nodata.png') }}" width="30%" class="rounded mx-auto d-block" alt="data tidak ditemukan">
                                            <div class="row mt-5">
                                                <div class="col text-center">
                                                <button class="btn btn-success btn-small">Home Page</button>
                                                </div>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </section>
        
        {{-- <section id="content" class="gray-area">
            <div class="container text-left shortcode">
                <div class="block">
                    <div class="row">
                        <div class="col-lg-9 listing-style3 cruise">
                            @forelse ($carts as $cart)
                                <article class="box">
                                    <figure class="col-sm-4">
                                        <a title="" href="#" class="hover-effect">
                                             <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt=""> 
                                            <img width="270" height="160" alt="" src="http://api-dipass-provider.test/file/bus/{{ $cart->route->bus->photo }}">
                                        </a>
                                    </figure>
                                    <div class="details col-sm-8">
                                        <div class="clearfix">
                                            <h4 class="box-title pull-left">{{ $cart->route->title }}<small>{{ $cart->order_no }}</small></h4>
                                            <span class="price pull-right"><small>Total</small>Rp. {{ number_format($cart->total_price) }}</span>
                                        </div>
                                        <div class="character clearfix">
                                            <div class="col-xs-3 cruise-logo">
                                                @if($cart->route->company->logo === null)
                                                    {{ $cart->route->company->company_name }}
                                                @else
                                                    <img width="20%" src="http://api-dipass-provider.test/file/logo/{{ $cart->route->company->logo }}" alt="logo company">
                                                    {{ $cart->route->company->company_name }}
                                                @endif 
                                            </div>
                                            <div class="col-xs-4 date">
                                                <i class="soap-icon-clock yellow-color"></i>
                                                <div>
                                                    <span class="skin-color">Date</span><br>{{ $cart->date }}
                                                </div>
                                            </div>
                                            <div class="col-xs-5 departure">
                                                <i class="soap-icon-departure yellow-color"></i>
                                                <div>
                                                    <span class="skin-color">berangkat</span><br>{{ $cart->departurePoint->point_name }}, {{ $cart->departureCity->city_name }} 
                                                </div>
                                            </div>
                                            <div class="col-xs-5 departure">
                                                <i class="soap-icon-departure yellow-color"></i>
                                                <div>
                                                    <span class="skin-color">Tiba</span><br>{{ $cart->arrivalPoint->point_name }}, {{ $cart->arrivalCity->city_name }} 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <div class=" pull-left">
                                                <p>
                                                    @if ($cart->status === 'Pending')
                                                        <a class="button btn-small yellow">Sedang dikonfirmasi</a>
                                                    @elseif ($cart->status === 'Success')
                                                        <a class="button btn-small green">Pesanan selesai</a>
                                                    @else
                                                        <a class="button btn-small red">Pesanan Expired</a>
                                                    @endif
                                                </p>
                                            </div>
                                            @if ($cart->status === 'Pending')
                                                <a href="{{ url('/checkout/confirm/') }}/{{ $cart->id}}" class="button btn-small pull-right">Detail Order</a>
                                            @else
                                            <a href="{{ url('/sukses/') }}/{{ $cart->id}}" class="button btn-small pull-right">Detail Order</a>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </article>
                            @empty
                                
                            @endforelse
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
                        </div>
                    </div>
                </div>
                
            </div>
        </section> --}}
        
@endsection

@push('addon-script')
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
    
<!-- Google Map Api -->
<script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="{{ asset('/js/gmap3.min.js') }}"></script>
    <script type="text/javascript">
        tjq(document).ready(function() {
            tjq("#price-range").slider({
                range: true,
                min: 65000,
                max: 1000000,
                values: [ 65000, 1000000 ],
                slide: function( event, ui ) {
                    tjq(".min-price-label").html( "Rp." + ui.values[ 0 ]);
                    tjq(".max-price-label").html( "Rp." + ui.values[ 1 ]);
                }
            });
            tjq(".min-price-label").html( "Rp." + tjq("#price-range").slider( "values", 0 ));
            tjq(".max-price-label").html( "Rp." + tjq("#price-range").slider( "values", 1 ));

            function convertTimeToHHMM(t) {
                var minutes = t % 60;
                var hour = (t - minutes) / 60;
                var timeStr = (hour + "").lpad("0", 2) + ":" + (minutes + "").lpad("0", 2);
                var date = new Date("2014/01/01 " + timeStr + ":00");
                var hhmm = date.toLocaleTimeString(navigator.language, {hour: '2-digit', minute:'2-digit'});
                return hhmm;
            }
            tjq("#flight-times").slider({
                range: true,
                min: 0,
                max: 1440,
                step: 5,
                values: [ 360, 1200 ],
                slide: function( event, ui ) {
                    
                    tjq(".start-time-label").html( convertTimeToHHMM(ui.values[0]) );
                    tjq(".end-time-label").html( convertTimeToHHMM(ui.values[1]) );
                }
            });
            tjq(".start-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 0 )) );
            tjq(".end-time-label").html( convertTimeToHHMM(tjq("#flight-times").slider( "values", 1 )) );
        });
    </script>
@endpush