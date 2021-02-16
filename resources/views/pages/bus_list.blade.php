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
                    <h2 class="entry-title">Daftar Pencarian Bus</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li class="active">Daftar Bus</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                            <h4 class="search-results-title"><i class="soap-icon-search"></i><b>{{ $total }}</b> Hasil ditemukan</h4>
                            <div class="toggle-container filters-container">
                                <div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Ubah Pencarian</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse collapse">
                                        <div class="panel-content">
                                            <form action="{{ route('bus-list') }}">
                                                <div class="form-group">
                                                    <label>Berangkat dari</label>
                                                    <select class="full-width" data-placeholder="Pilih Asal Keberangkatan " name='from' data-init-plugin="select2" required>
                                                        @foreach ($kota as $item)
                                                            <option value="{{$item->id}}"
                                                            @if($from == $item->id)
                                                            selected
                                                            @endif
                                                            >{{$item->city_name}}</option>
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sampai</label>
                                                    <select class="full-width" data-placeholder="Pilih Tujuan  " name='to' data-init-plugin="select2" required>
                                                        @foreach ($kota as $item)
                                                            <option value="{{$item->id}}"
                                                            @if($to == $item->id)
                                                            selected
                                                            @endif
                                                            >{{$item->city_name}}</option>
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date" value="{{ $date }}" class="input-text full-width" />
                                                    </div>
                                                </div>
                                                <br />
                                                <button class="btn-medium purple uppercase full-width">Cari lagi</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 col-md-9">
                            {{-- <div class="sort-by-section clearfix box">
                                <h4 class="sort-by-title block-sm">Filter Berdasarkan:</h4>
                                <ul class="sort-bar clearfix block-sm">
                                    <li class="sort-by-name"><a class="sort-by-container" href="#"><span>Nama</span></a></li>
                                    <li class="sort-by-price"><a class="sort-by-container" href="#"><span>Harga</span></a></li>
                                    <li class="sort-by-rating active"><a class="sort-by-container" href="#"><span>Waktu</span></a></li>
                                </ul>
                            </div> --}}
                            <div class="flight-list listing-style3 flight">
                                 @foreach ($schedules as $schedules)
                                    <article class="box">
                                        <figure class="col-xs-3 col-sm-2">
                                            <span><img alt="" src="http://api-dipass-provider.test/file/bus/{{ $schedules->route->bus->photo }}"></span>
                                        </figure>
                                        <div class="details col-xs-9 col-sm-10">
                                            <div class="details-wrapper">
                                                <div class="first-row">
                                                    <div>
                                                        <div class="row">
                                                            <div class="col-6 pl-2">
                                                                <h4 class="box-title">{{ $schedules->route->title }}<small>{{ $schedules->route->bus->bus_name }} - {{ $schedules->bus_number }}</small></h4>
                                                                <a class="button btn-mini stop">Kursi: {{ $schedules->route->bus->seat_count }}</a> 
                                                             </div>
                                                            <div class="col-6">
                                                                @foreach ($schedules->route->bus->facilities as $i)
                                                                <div class="amenities push-right">
                                                                    <a class="button btn-mini purple text-white mr-1">{{ $i->facility_name }} </a>
                                                                    {{-- &nbsp -  --}}
                                                                </div>
                                                                @endforeach 
                                                            </div>  
                                                        </div>                                                      
                                                    </div>
                                                    <div>
                                                        <span class="price"><small>Harga/Orang</small>Rp. {{ number_format($schedules->price) }}</span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="second-row">
                                                    <div class="time">
                                                        <div class="take-off col-sm-4">
                                                            <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">Berangkat <br></span>{{ $schedules->route->arrival->city_name }}<br />{{ $schedules->date->format('d/m/Y') }} <br>{{ $schedules->route->board_points->first()->time }} - hari ke {{ $schedules->route->board_points->first()->day }} 
                                                            </div>
                                                        </div>
                                                        <div class="landing col-sm-4">
                                                            <div class="icon"><i class="soap-icon-plane-right yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">Tiba <br></span>{{ $schedules->route->departure->city_name }}<br />{{ $schedules->date->format('d/m/Y') }} <br>{{ $schedules->route->board_points->last()->time }} - hari ke {{ $schedules->route->board_points->last()->day }} 
                                                            </div>
                                                        </div>
                                                        <div class="total-time col-sm-4">
                                                            <div class="icon"><i class="soap-icon-clock yellow-color"></i></div>
                                                            <div>
                                                                <span class="skin-color">total time</span><br />3 Jam, 40 Menit
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="action">
                                                          <a href="{{ route('bus-detail', $schedules->id) }}" class="btn btn-success btn-small full-width">Pilih Sekarang</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                 @endforeach                             
                                                               
                            </div>
                            <a class="button uppercase full-width btn-large">load more listings</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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