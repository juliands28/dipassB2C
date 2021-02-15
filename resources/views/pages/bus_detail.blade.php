@extends('layouts.app')

@section('title')
    Bus Detail - dipass-B2C
@endsection

@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/animate.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/jquery-steps/steps.css') }}">

    <style>
        #seat_container .check-seat {
            box-sizing: border-box !important;
            display: none !important;
        }

        .pessenger-border {
            border: 1px solid #d3d3d3;
            border-radius: 4px;
            padding: 15px;
        }
    </style> --}}
@endpush



@section('content')
    <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Bus {{ $item->route->bus->bus_name }}  - {{ $item->route->title }} </h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li class="active">Bus Detail</li>
                </ul>
            </div>
        </div>
        <section id="content">
            <div class="container flight-detail-page">
                <div class="row">
                    <div id="main" class="col-md-9">
                        <div class="tab-container style1 box" id="flight-main-content">
                            <ul class="tabs">
                                <li class="active"><a data-toggle="tab" href="#photo-tab">photo</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="photo-tab" class="tab-pane fade in active">
                                    <div class="featured-image image-container text-center">
                                        <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="flight-features" class="tab-container">
                            <ul class="tabs">
                                <li class="active"><a href="#flight-details" data-toggle="tab">Bus Details</a></li>
                                <li><a href="#inflight-features" data-toggle="tab">Fasilitas Bus</a></li>
                                <li><a href="#flgiht-seat-selection" data-toggle="tab">Pilih Bangku</a></li>
                                {{-- <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="flight-details">
                                    <div class="intro table-wrapper full-width hidden-table-sm box">
                                        <div class="col-md-4 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Nama Bus:</dt><dd>{{ $item->route->bus->bus_name }}</dd>
                                                <dt>kategori Bus:</dt><dd>{{ $item->route->bus->category->category_name }}</dd>
                                                <dt>kelas Bus:</dt><dd>{{ $item->route->bus->class->class_name }}</dd>
                                                <dt>Nomor Bus:</dt><dd>{{ $item->bus_number }}</dd>
                                                <dt>Fasilitas dalam Bus:</dt><dd>{{ $item->route->bus->facilities->random()->facility_name }}</dd>
                                                {{-- <dt>Base fare:</dt><dd>$320.00</dd>
                                                <dt>Taxes &amp; Fees:</dt><dd>$300.00</dd> --}}
                                                <dt>total Harga:</dt><dd>Rp. {{ number_format($item->price) }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-8 table-cell">
                                            <div class="detailed-features booking-details">
                                                <div class="travelo-box">
                                                    <a href="#" class="button btn-mini yellow pull-right">Kursi: {{ $item->route->bus->seat_count }}</a>
                                                    <h4 class="box-title">{{ $item->route->title }}<small>One Way</small></h4>
                                                </div>
                                                <div class="table-wrapper flights">
                                                    <div class="table-row first-flight">
                                                        <div class="table-cell logo">
                                                            <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt="">
                                                            <label>{{ $item->route->departure->city_name }} - {{ $item->route->arrival->city_name }}</label>
                                                        </div>
                                                        <div class="table-cell timing-detail">
                                                            <div class="timing">
                                                                <div class="check-in">
                                                                    <label>Berangkat</label>
                                                                    <span>{{ $item->date->format('d/m/Y') }} - {{ $item->route->board_points->first()->time }}</span>
                                                                </div>
                                                                <div class="duration text-center">
                                                                    <i class="soap-icon-clock"></i>
                                                                    <span>time</span>
                                                                </div>
                                                                <div class="check-out">
                                                                    <label>Tiba</label>
                                                                    <span>{{ $item->date->format('d/m/Y') }} - {{ $item->route->board_points->last()->time }}                                                                                                                                           </span>
                                                                </div>
                                                            </div>
                                                            {{-- <label class="layover">Layover : 1h, 40m</label> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="long-description">
                                        <h2>Tentang Bus Budiman</h2>
                                        <p class="text-justify">
                                            Saleh Budiman dilahirkan dalam keluarga yang sederhana. Awalnya, ia hanyalah seorang pedagang kecil di Tasikmalaya. Mimpinya sejak kecil adalah menjadi orang kaya, namun tetap dalam kesederhanaan.

                                            Ia mulai berusaha untuk mewujudkan mimpinya dengan membuat kas atau celengan dari kayu. Setiap hari, celengan itu diisi dengan uang 100 Rupiah. Beberapa saat kemudian, tabungannya telah terkumpul hingga 80 ribu Rupiah. Dengan uang hasil tabungannya tadi, ia membeli mobil bekas dengan cara berkongsi dengan pengusaha dari Banjaran, Bandung. Usahanya terus berkembang hingga memiliki truk sebanyak 20 unit dan mengubah usahanya menjadi usaha angkutan bis dengan nama "Budiman".
                                            <br /><br />
                                            Bermodal empat unit bus bersasis Mercedes–Benz OF 1113 sebagai armada awal, keempatnya diberi nomor sesuai urutan OF 001, OF 002, OF 003, OF 004 dan melayani lokal Priangan Timur saja seperti Tasikmalaya dan Ciamis. Pada masa itu, Budiman yang masih seumur jagung harus berhadapan dengan para senior yang sudah menguasai jalur tersebut, seperti Merdeka Group. Namun dengan tekad yang kuat serta berani, Budiman berhasil bersaing dengan lawan-lawannya tersebut, meskipun munculnya paling belakangan. Saat ini, keempat unit bus "Babat Alas" tersebut masih dipertahankan oleh pihak Budiman, sebagai tanda bahwa bus-bus tersebut memiliki kiprah yang besar dalam perkembangan PO Budiman hingga saat ini.
                                            <br /><br />
                                            Beberapa tahun kemudian, Budiman mulai memperluas jangkauan trayeknya menuju Jabodetabek, Wonosobo, Yogyakarta, Cirebon, Semarang, dan kota-kota lain di Jawa Tengah, Jawa Timur dan Jawa Barat.
                                        </p>
                                    </div> --}}
                                </div>
                                <div class="tab-pane fade" id="inflight-features">
                                    <h2>Fasilitas Bus {{ $item->route->bus->bus_name }}</h2>
                                    <ul class="amenities clearfix style1 box">

                                        {{-- @foreach($item as $facility)
                                            <option value="{{ {{ $item->route->bus->facilities->facility_name }} }}">
                                                {{ $travel_package->title }}
                                            </option>
                                        @endforeach --}}
                                        {{-- @foreach ($item as $i)
                                            <li class="col-md-4 col-sm-6">
                                                <div class="icon-box style1"><i class="soap-icon-wifi"></i>{{ $i->route->bus->facilities->pivot->facility_name }}</div>
                                            </li>
                                        @endforeach --}}
                                        
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="flgiht-seat-selection">
                                    <h2>Select your Seats</h2>
                                    <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map.  You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                                    <hr>
                                    <div class="image-box style12">
                                        <article class="box" id="seat_container">
                                            
                                            <div class="details">
                                                <h4 class="box-title">pilih bangku</h4>
                                                {{ $item->route->bus  }} 
                                                
                                            </div>
                                        </article>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        <article class="detailed-logo">
                            <figure>
                                <img src="http://api-dipass-provider.test/file/bus/{{ $item->route->bus->photo }}" alt="">
                            </figure>
                            <div class="details">
                                <h2 class="text-center box-title">{{ $item->route->bus->bus_name }}<small>Satu Perjalanan</small></h2>
                                <span class="price clearfix">
                                    <small class="pull-left">Harga/Orang</small>
                                    <span class="pull-right">Rp. {{ number_format($item->price) }}</span>
                                </span>
                                
                                {{-- <div class="duration">
                                    <i class="soap-icon-clock"></i>
                                    <dl>
                                        <dt class="skin-color">Waktu Tempuh:</dt>
                                        <dd>3 Jam, 40 Menit</dd>
                                    </dl>
                                </div> --}}
                                
                                <p class="text-justify description">{!!  $item->route->description !!}</p>
                                <a href="{{ route('bus-pesan') }}" class="button green full-width uppercase btn-medium">Pesan Sekarang</a>
                            </div>
                        </article>
                        <div class="travelo-box contact-box">
                            <h4>Butuh Bantuan Kami?</h4>
                            <p class="text-left">Untuk respon yang lebih cepat, sampaikan pertanyaan atau permintaan Anda melalui Nomor Telpon ini.</p>
                            <address class="contact-details">
                                <span class="contact-phone"><i class="soap-icon-phone"></i> 1-800-123</span>
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
{{-- seat booking --}}
    {{-- <script src="{{ asset('assets/libs/jquery-steps/build/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('src/booking.js') }}"></script> --}}
    {{-- <script>
        BookingController.order('{{ Session::get('admin-auth.token') }}', {
            id: {{ $id }},
            departure: {{ $departure }},
            pickup: {{ $pickup }},
            arrival: {{ $arrival }},
            drop: {{ $drop }},
        });
    </script> --}}
{{-- calendar --}}
<script type="text/javascript" src="/js/calendar.js"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="/components/flexslider/jquery.flexslider-min.js"></script>
    
    <script type="text/javascript">
        tjq(document).ready(function() {
            // calendar panel
            var cal = new Calendar();
            var unavailable_days = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
            var price_arr = {3: '$170', 4: '$170', 5: '$170', 6: '$170', 7: '$170', 8: '$170', 9: '$170', 10: '$170', 11: '$170', 12: '$170', 13: '$170', 14: '$170', 15: '$170', 16: '$170', 17: '$170'};

            var current_date = new Date();
            var current_year_month = (1900 + current_date.getYear()) + "-" + (current_date.getMonth() + 1);
            tjq("#select-month").find("[value='" + current_year_month + "']").prop("selected", "selected");
            cal.generateHTML(current_date.getMonth(), (1900 + current_date.getYear()), unavailable_days, price_arr);
            tjq(".calendar").html(cal.getHTML());
            
            tjq("#select-month").change(function() {
                var selected_year_month = tjq("#select-month option:selected").val();
                var year = parseInt(selected_year_month.split("-")[0], 10);
                var month = parseInt(selected_year_month.split("-")[1], 10);
                cal.generateHTML(month - 1, year, unavailable_days, price_arr);
                tjq(".calendar").html(cal.getHTML());
            });
            
            
            tjq(".goto-writereview-pane").click(function(e) {
                e.preventDefault();
                tjq('#hotel-features .tabs a[href="#hotel-write-review"]').tab('show')
            });
            
            // editable rating
            tjq(".editable-rating.five-stars-container").each(function() {
                var oringnal_value = tjq(this).data("original-stars");
                if (typeof oringnal_value == "undefined") {
                    oringnal_value = 0;
                } else {
                    oringnal_value = 10 * parseInt(oringnal_value);
                }
                tjq(this).slider({
                    range: "min",
                    value: oringnal_value,
                    min: 0,
                    max: 50,
                    slide: function( event, ui ) {
                        
                    }
                });
            });
        });
    </script>
@endpush