@extends('layouts.app')

@section('title')
    dipass B2C Homepage
@endsection

@push('addon-style')
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
<!-- Javascript Page Loader -->
<script type="text/javascript" src="{{ asset('/js/pace.min.js') }}" data-pace-options='{ "ajax": false }'></script>
<script type="text/javascript" src="{{ asset('/js/page-loading.js') }}"></script>

<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('/images/header1.jpg') }}" wit alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('/images/header1.jpg') }}" width="30%" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('/images/header1.jpg') }}" alt="Third slide">
        </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
</div>

    {{-- <div id="slideshow">
        <div class="fullwidthbanner-container">
            <div class="revolution-slider" style="height: 0; overflow: hidden;">
                <ul>    <!-- SLIDE  -->
                    <!-- Slide1 -->
                    <li data-transition="zoomin" data-slotamount="7" data-masterspeed="1500">
                        <!-- MAIN IMAGE -->
                        <img src="/images/header1.jpg" alt="">
                    </li>
                    
                    <!-- Slide2 -->
                    <li data-transition="zoomout" data-slotamount="7" data-masterspeed="1500">
                        <!-- MAIN IMAGE -->
                        <img src="/images/header1.jpg" alt="">
                    </li>
                    
                    <!-- Slide3 -->
                    <li data-transition="slidedown" data-slotamount="7" data-masterspeed="1500">
                        <!-- MAIN IMAGE -->
                        <img src="/images/header1.jpg" alt="">
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}
    <section id="content">
        <div class="search-box-wrapper">
            <div class="search-box container">
                {{-- <ul class="search-tabs clearfix">
                    <li><a href="#flight-and-hotel-tab" data-toggle="tab">BUS</a></li>                    
                </ul> --}}
                {{-- <div class="visible-mobile">
                    <ul id="mobile-search-tabs" class="search-tabs clearfix">
                        <li><a href="#flight-and-hotel-tab">BUS</a></li>
                    </ul>
                </div>                 --}}
                <div class="search-tab-content mt-3">
                    <div class="tab-pane fade active in" id="flight-and-hotel-tab">
                        <form action="{{ route('search-bus') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <h4 class="title">Mau Kemana?</h4>
                                    <div class="form-group">
                                        <label>Dari</label>
                                        <select class="form-control single-select" data-placeholder="Pilih Asal Keberangkatan " name='departure_city' data-init-plugin="select2" required>
                                            @foreach ($kota as $item)
                                                <option value="{{$item->id}}">{{$item->city_name}}</option>
                                            @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Pergi ke</label>
                                        <select class="form-control single-select" data-placeholder="Pilih tujuan Keberangkatan " name='arrival_city' data-init-plugin="select2" required>
                                            @foreach ($kota as $item)
                                                <option value="{{$item->id}}">{{$item->city_name}}</option>
                                            @endforeach
                                      </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <h4 class="title">Mau Berangkat Kapan?</h4>
                                    <label>Tanggal Pergi</label>
                                    <div class="form-group row">
                                        <div class="col-xs-12">
                                            <div class="datepicker-wrap">
                                                <input type="text" name="date" id="autoclose-datepicker" class="input-text full-width" placeholder="Pilih Tanggal" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="title"> </h4>
                                    <div class="form-group row">
                                        <div class="col-xs-6 pull-right">
                                            <label>&nbsp;</label>
                                            <button type="submit" 
                                            {{-- onclick="window.location.href='{{ route('bus-list') }}'"  --}}
                                            class="purple full-width">Cari Sekarang</button>
                                        </div>                                        
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <!--Inputtags Js-->
   <script src="{{ asset('assets/plugins/inputtags/js/bootstrap-tagsinput.js') }}"></script>
    <!--Select Plugins Js-->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
       <!--Bootstrap Datepicker Js-->
       <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
       <script>
         $('#autoclose-datepicker').datepicker({
           autoclose: true,
           todayHighlight: true
         });
       </script>
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
@endpush
