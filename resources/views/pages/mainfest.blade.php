@extends('layouts.app')

@section('title')
    Pesanan Sukses - dipass-B2C
@endsection
@push('prepend-style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@push('prepend-style')
    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">    
  <!-- Dropzone css -->
  <link href="{{ asset('/assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>
@endpush

@section('content')
<div class="page-title-container">
    <div class="container">
        <div class="page-title pull-left">
            <h2 class="entry-title">Terima Kasih</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{ route('home') }}">HOME</a></li>
            <li><a href="{{ route('bus-pesan') }}">Pemesanan Tiket Bus</a></li>
            <li class="active">Terima Kasih</li>
        </ul>
    </div>
</div>
<section id="content" class="gray-area">
    <div class="container">
      <div class="card">
        <div class="card-body">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  
                  <h3>
                    Invoice
                    <small>#{{ $booking->PNR }}</small>
                  </h3>
                </section>

                <!-- Main content -->
                <section class="invoice">
                  <!-- title row -->
                  <div class="row mt-3">
                    <div class="col-lg-6">
                      <img src="{{ asset('/images/logo.png') }}" alt="logo">
                    </div>
                    <div class="col-lg-6">
                    <h2 class="float-sm-right">Dipass B2C<i>E-Tiket</i></h2>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-6">
                      <h4><i class="fa fa-globe"></i> Dipass B2C</h4>
                    </div>
                    <div class="col-lg-6">
                    <h5 class="float-sm-right">Tanggal: {{ $booking->booking_date }}</h5>
                    </div>
                  </div>
        
                  <hr>
                  <div class="row invoice-info mb-5">
                    <div class="col-sm-4 invoice-col">
                      Berangkat
                      <address>
                       <strong>{{ $booking->departureCity->city_name }}</strong>
                       <br>
                       {{ $booking->departurePoint->point_name }}<br>
                       {{ $booking->departure_date }}<br>
                       {{ $booking->departure_time }}<br>
                      </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      Tiba
                      <address>
                        <strong>{{ $booking->arrivalCity->city_name }}</strong>
                        <br>
                        {{ $booking->arrivalPoint->point_name }}<br>
                        {{ $booking->arrival_date }}<br>
                        {{ $booking->arrival_time }}<br>
                       </address>
                    </div><!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <b>Invoice #{{ $booking->PNR }}</b><br>
                      <br>
                      <b>Order ID:</b> {{ $booking->orders[0]->order_no }}<br>
                      <b>Nama Bus:</b> {{ $booking->busNumber->bus->bus_name }}<br>
                      <b>Plat Nomor:</b> {{ $booking->busNumber->bus_number }}
                    </div><!-- /.col -->
                  </div><!-- /.row -->

                  <!-- Table row -->
                  <div class="row mb-5">
                    <div class="col-12 table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Ticket Number</th>
                            <th>Penumpang</th>
                            <th>NIK</th>
                            <th>Seat Number</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($booking->passengers as $penumpang)                              
                          <tr>
                            <td>{{ $penumpang->ticket_number }}</td>
                            <td>{{ $penumpang->name }}</td>
                            <td>{{ $penumpang->nik }}</td>
                            <td>{{ $penumpang->seat_number }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                  <br>

                  <div class="row">
                    <!-- accepted payments column -->
                    
                    <div class="col-lg-3 payment-icons">
                      <p class="lead">Booking Code(PNR):</p>
                      <div class="text-center">
                        {!! QrCode::size(100)->generate($booking->PNR); !!}
                      </div>
                      <p class="text-muted text-center p-2 mt-3 border rounded">
                        {{ $booking->PNR }}
                      </p>
                    </div><!-- /.col -->
                    <div class="col-lg-3 payment-icons">
                      <p class="lead">Payment Methods:</p>
                      <img src="/images/bank-dki.png" alt="Bank DKI">
                    </div><!-- /.col -->
                    <div class="col-lg-6">
                      {{-- <p class="lead">Amount Due 2/22/2014</p> --}}
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                          <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>Rp. {{ number_format($booking->orders[0]->total_price) }}</td>
                          </tr>
                        </tbody>
                    </table>
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                  
                  
                  <hr>
                  <div class="row">
                    <!-- accepted payments column -->
                    
                    <div class="col-lg-12 payment-icons">
                      <h2>Terms & Condition </h2>
                      <ul class="decimal box">
                        <li>Tarif sudah termasuk asuransi.</li>
                        <li>Penumpang berusia 3 tahun atau lebih dikenakan tarif dewasa.</li>
                        <li>Penumpang berusia dibawah 3 tahun (infant) ke satu dari satu penumpang dengan tarif dewasa jika tidak mengambil tempat duduk sendiri tidak dikenakan bea.</li>
                        <li>Tiket hanya berlaku untuk pengangkutan dari stasiun keberangkatan ke stasiun kedatangan sebagaimana tercantum dalam tiket.</li>
                        <li>Dalam hal penumpang memiliki lebih dari satu tiket Bus (tiket terpisah) yang memiliki sifat persambungan/terusan, penumpang tertinggal oleh BUS terusannya diakibatkan BUS yang dinaiki sebelumnya terlambat atau sebab lainnya maka untuk tiket BUS terusannya hangus, tidak ada pengembalian bea. Pastikan tersedia waktu yang cukup.</li>
                        <li>Tiket berlaku dan sah apabila nama dan nomor kode booking, tanggal dan jam keberangkatan, kelas dan relasi perjalanan yang tercantum dalam tiket telah sesuai dengan BUS yang dinaiki.</li>
                        <li>Kedapatan tidak memiliki tiket yang sah diatas BUS diturunkan dari kereta api pada kesempatan pertama.</li>
                        <li>Tiket tidak bisa dibatalkan ataupun diubah jadwal, kecuali ditentukan lain oleh PO.</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                  

                  <!-- this row will not appear when printing -->
                  <hr>
                  <div class="row no-print">
                    <div class="col-lg-3">
                      <a href="{{ route('manifest-pdf', $booking->id) }}" target="_blank" class="btn btn-outline-secondary m-1"><i class="fa fa-print"></i> Print</a>
                        </div>
                        <div class="col-lg-9">
                        <div class="float-sm-right">
                          <button class="btn btn-success m-1"><i class="fa fa-credit-card"></i> Submit Payment</button>
                          <button class="btn btn-primary m-1"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                    </div>
                  </div>
                </section><!-- /.content -->
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
<!-- Dropzone JS  -->
<script src="{{ asset('/assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
@endpush