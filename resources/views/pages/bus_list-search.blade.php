@extends('layouts.app')

@section('title')
    Bus List - dipass-B2C
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
      <!--multi select-->
  <link href="{{ asset('assets/plugins/jquery-multi-select/multi-select.css') }}" rel="stylesheet" type="text/css">
  <!--Select Plugins-->
  <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
  <!--inputtags-->
  <link href="{{ asset('assets/plugins/inputtags/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
  <!--Bootstrap Datepicker-->
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
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
                                            <form action="{{ route('search-bus') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label>Berangkat dari</label>
                                                    <select class="full-width single-select" data-placeholder="Pilih Asal Keberangkatan " name='departure_city' data-init-plugin="select2" required>
                                                        @foreach ($kota as $i)
                                                            <option value="{{$i->id}}"
                                                            @if($departure_city == $i->id)
                                                            selected
                                                            @endif
                                                            >{{$i->city_name}}</option>
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sampai</label>
                                                    <select class="full-width single-select" data-placeholder="Pilih Tujuan  " name='arrival_city' data-init-plugin="select2" required>
                                                        @foreach ($kota as $i)
                                                            <option value="{{$i->id}}"
                                                            @if($arrival_city == $i->id)
                                                            selected
                                                            @endif
                                                            >{{$i->city_name}}</option>
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
                                                <button type="submit" class="btn-medium purple uppercase full-width">Cari lagi</button>
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
                                @forelse ($schedule as $schedules)
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
                                                            <h4 class="box-title">
                                                                @if($schedules->route->company->logo === null)
                                                                    {{ $schedules->route->company->company_name }}
                                                               @else
                                                                    <img width="20%" src="http://api-dipass-provider.test/file/logo/{{ $schedules->route->company->logo }}" alt="logo company">
                                                                    {{ $schedules->route->company->company_name }}
                                                               @endif 
                                                                <br>
                                                                <br>
                                                                {{ $schedules->route->title }}<small>{{ $schedules->route->bus->bus_name }} - {{ $schedules->bus_number }}</small></h4>
                                                            <a class="button btn-mini stop">Kursi: {{ $schedules->route->bus->seat_count }}</a> 
                                                         </div>
                                                        <div class="col-6">
                                                            @foreach ($schedules->route->bus->facilities as $i)
                                                            <div class="amenities push-right">
                                                                <a class="button btn-mini purple text-white mr-1">{{ $i->first()->facility_name }} </a>
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
                                                    <div class="col-sm-4">
                                                        <div class="icon"><img src="https://img.icons8.com/dotty/20/350b40/get-on-bus.png"/></div>
                                                        <div>
                                                            <span class="skin-color">Berangkat <br></span>{{ $schedules->route->points->first()->point_name }}<br />{{ $schedules->date->format('F j, Y') }} <br>{{ $schedules->route->board_points->first()->time }} - hari ke {{ $schedules->route->board_points->first()->day }} 
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="icon"><img src="https://img.icons8.com/dotty/20/350b40/get-off-bus.png"/></div>
                                                        <div>
                                                            <span class="skin-color">Tiba <br></span>{{ $schedules->route->points ->last()->point_name }}<br />{{ $schedules->date->format('F j, Y') }} <br>{{ $schedules->route->board_points->last()->time }} - hari ke {{ $schedules->route->board_points->last()->day }} 
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
                                @empty
                                <img src="{{ asset('/images/nodata.png') }}" width="50%" class="rounded mx-auto d-block" alt="data tidak ditemukan">
                                
                                <a data-toggle="collapse" href="#modify-search-panel" class="button uppercase full-width btn-large">Data tidak ditemukan, Silakan pilih Route lain</a>
                                
                                @endforelse                            
                                                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('addon-script')
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- Google Map Api -->
<script type='text/javascript' src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="{{ asset('/js/gmap3.min.js') }}"></script>
<!--Inputtags Js-->
<script src="{{ asset('assets/plugins/inputtags/js/bootstrap-tagsinput.js') }}"></script>
<!--Select Plugins Js-->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();
  
        $('.multiple-select').select2();

    //multiselect start

        $('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });

        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function (ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function (e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function (e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

     $('.custom-header').multiSelect({
          selectableHeader: "<div class='custom-header'>Selectable items</div>",
          selectionHeader: "<div class='custom-header'>Selection items</div>",
          selectableFooter: "<div class='custom-header'>Selectable footer</div>",
          selectionFooter: "<div class='custom-header'>Selection footer</div>"
        });



      });

</script>
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