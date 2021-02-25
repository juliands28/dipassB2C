@extends('layouts.app')

@section('title')
    Bus Detail - dipass-B2C
@endsection


@section('content')
    <div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Bus {{ $item->route->bus->bus_name }}  - {{ $item->route->title }} </h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="{{ route('home') }}">HOME</a></li>
                    <li><a href="{{ route('search-bus') }}">Daftar Bus</a></li>
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
                                {{-- <li><a href="#flgiht-seat-selection" data-toggle="tab">Pilih Bangku</a></li> --}}
                                {{-- <li><a href="#flight-fare-rules" data-toggle="tab">Fare Rules</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="flight-details">
                                    <div class="intro table-wrapper full-width hidden-table-sm box">
                                        <div class="col-md-4 col-sm-5 table-cell travelo-box">
                                            <dl class="term-description">
                                                <dt>Nama Bus:</dt><dd>{{ $item->route->bus->bus_name }}</dd>
                                                <dt>kategori Bus:</dt><dd>{{ $item->route->bus->category->category_name }}</dd>
                                                <dt>kelas Bus:</dt><dd>{{ $item->route->bus->class->class_name }}</dd>
                                                <dt>Nomor Bus:</dt><dd>{{ $item->bus_number }}</dd>
                                                <dt>total Harga:</dt><dd>Rp. {{ number_format($item->price) }}</dd>
                                            </dl>
                                        </div>
                                        <div class="col-md-8 col-sm-7 table-cell">
                                            <div class="detailed-features booking-details">
                                                <div class="travelo-box">
                                                    <a href="#" class="button btn-mini yellow pull-right">Kursi: {{ $item->route->bus->seat_count }}</a>
                                                    <h4 class="box-title">
                                                        @if($item->route->company->logo === null)
                                                            {{ $item->route->company->company_name }}
                                                        @else
                                                            {{ $item->route->company->logo }}
                                                        @endif
                                                        <br><br>
                                                        {{ $item->route->title }}</h4>
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="inflight-features">
                                    <h2>Fasilitas Bus {{ $item->route->bus->bus_name }}</h2>
                                    <ul class="amenities clearfix style1 box">
                                        @foreach ($item->route->bus->facilities as $i)
                                            <li class="col-md-4 col-sm-6">
                                                <div class="icon-box style1"><i class="soap-icon-check-1"></i>{{ $i->facility_name }}</div>
                                            </li>
                                        @endforeach
                                        
                                        
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="flgiht-seat-selection">
                                    <h2>Select your Seats</h2>
                                    <p>Would you like a window seat or treat yourself to more comfort? Select your seats online in advance with our easy-to-use seat map.  You can choose and change your seat until 48 hours before departure, when booking on Travelo.com. Also you can choose and change your seats at a self-service machine at the airport.</p>
                                    <hr><div class="col-md-12 mb-2">
                                        <p>
                                            @php $totalPrice = 0 @endphp
                                            <input type="hidden" name="route_id" id="route_id" value="{{ $item->route_id }}">
                                            <input type="hidden" name="schedule_id" id="schedule_id" value="{{ $item->id }}">
                                            <input type="hidden" name="departure_city" id="departure_city" value="{{ $item->route->departure_id }}">
                                            <input type="hidden" name="departure_point" id="departure_point" value="{{$item->route->points->first()->id}}">
                                            <input type="hidden" name="departure_date" id="departure_date" value="{{ $item->date->format('d/m/Y') }}">
                                            <input type="hidden" name="departure_time" id="departure_time" value="{{ $item->route->board_points->first()->time }}">
                                            <input type="hidden" name="arrival_city" id="arrival_city" value="{{ $item->route->arrival_id }}">
                                            <input type="hidden" name="arrival_point" id="arrival_point" value="{{ $item->route->points ->last()->id }}">
                                            <input type="hidden" name="arrival_date" id="arrival_date" value="{{ $item->date->format('d/m/Y') }}">
                                            <input type="hidden" name="arrival_time" id="arrival_time" value="{{ $item->route->board_points->last()->time }}">
                                            @php $totalPrice += $item->price @endphp
                                            <input type="hidden" name="total_price" id="total_price" value="{{ $item->price }}">                                        
                                        </p>
                                    </div>
                                    {{-- <div class="image-box style12">
                                        <article class="box" id="seat_container">
                                            
                                            <div class="details">
                                                <table class="table table-bordered table-rensponsif" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            @foreach ($item->route->bus->layout['component'] as $key => $val)
                                                            <td>
                                                                @if($val['type'] === 'seat')
                                                                        {{ $val['seat_number'] }}
                                                                @else 
                                                                        {{ $val['type'] }}
                                                                @endif
                                                            </td>
                                                            @endforeach 
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                {{-- <h4 class="box-title">pilih bangku</h4>
                                                @foreach ($item->route->bus->layout['component'] as $key => $val)
                                                   @if($val['type'] === 'seat')
                                                        {{ $val['seat_number'] }}
                                                   @else 
                                                        {{ $val['type'] }}
                                                   @endif
                                                   br
                                                @endforeach 
                                            </div>
                                        </article>
                                        <hr>
                                    </div> --}}
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
                                <p class="text-justify description">{!!  $item->route->description !!}</p>
                                <div class="action">
                                    <a href="{{ route('checkout', $item->id) }}" class="btn btn-success btn-small full-width">Pilih Sekarang</a>
                              </div>                                
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
{{-- calendar --}}
<script type="text/javascript" src="{{ asset('/js/calendar.js') }}"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
    
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