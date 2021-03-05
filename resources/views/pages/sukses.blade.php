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
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>   
    <!-- animate CSS-->
  <link href="{{ asset('/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
@if ($order->status === 'Success')
<div class="section-success d-flex align-items-center mb-5">
    <div class="col text-center">
        <img class="mt-4" src="{{ asset('/images/header1.jpg') }}" alt="Pesan">
        <h1 class="mt-5">Yay! Pesanan sudah dikonfirmasi</h1>
        <p>
            Silakan untuk menlanjutkan proses cetak tiket 
            <br>
            klik dibawah ini untuk <span class="text-success">Mencetak Tiket</span> anda.
        </p>
        {{-- <a href="{{ route('manifest_process', $order->id) }}" class="btn btn-success btn-small">
            Cetak Tiket
        </a> --}}
        <br>
        @foreach ($bookings as $booking)
            @if ($booking->order->status === "Success")
                <!-- Small Size Modal -->
                <button class="btn btn-primary m-1" data-toggle="modal" data-target="#smallsizemodal">Cetak Tiket Kamu disini</button>
            @else 
                <a href="{{ route('home') }}" class="btn btn-success btn-small">
                    {{ $booking->order->first()->status }}
                </a>
            @endif
        @endforeach
        
        
        <!-- Modal -->
          <div class="modal fade" id="smallsizemodal">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><i class="fa fa-star"></i>Cetak Tiket</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Selangkah lagi Tiket kamu selesai. Kamu bisa berpergian kemana saja dengan menggunakan dipass. Selalu gunakan dipass disaat berpergian dengan bus antar kota</p>
                </div>
                <div class="modal-footer">
                  {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> --}}
                  <form action="{{ route('manifest-proses', $order->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i>Cetak Tiket</button>
                </form>
                </div>
              </div>
            </div>
          </div>

        <div id="travelo-login" class="travelo-login-box travelo-box">
            <form action="{{ route('manifest-proses', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <button
                type="submit"
                class="btn btn-success btn-small"
                >
                Cetak Tiket
                </button>
            </form>
        </div>
        
        
    </div>
</div>
@else
<div class="section-success d-flex align-items-center mb-5">
    <div class="col text-center">
        <img class="mt-4" src="{{ asset('/images/header1.jpg') }}" alt="Pesan">
        <h1 class="mt-5">Yay! Pesanan sedang di proses</h1>
        <p>
            Silakan menunggu, kami sedang mengecek Transaksi anda
            <br>
            cek email anda untuk tahap selanjutnya.
        </p>
        <br>
        <a href="{{ route('home') }}" class="btn btn-success btn-small">
            Home Page
        </a>
    </div>
</div>
@endif

@endsection

@push('addon-script')
{{-- calendar --}}
<script type="text/javascript" src="{{ asset('/js/calendar.js') }}"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>

	<!-- simplebar js -->
	<script src="{{ asset('/assets/plugins/simplebar/js/simplebar.js') }}"></script>
  <!-- waves effect js -->
  <script src="{{ asset('/assets/js/waves.js') }}"></script>
	<!-- sidebar-menu js -->
	<script src="{{ asset('/assets/js/sidebar-menu.js') }}"></script>
  <!-- Custom scripts -->
  <script src="{{ asset('/assets/js/app-script.js') }}"></script>

  <!--Sweet Alerts -->
  <script src="{{ asset('/assets/plugins/alerts-boxes/js/sweetalert.min.js') }}"></script>
  <script src="{{ asset('/assets/plugins/alerts-boxes/js/sweet-alert-script.js') }}"></script>
    
@endpush