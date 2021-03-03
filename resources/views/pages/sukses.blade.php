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
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>   
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
                <a type="hidden" href="{{ route('home') }}" class="btn btn-success btn-small">
                    {{ $booking->order->first()->status }}
                </a>
           @else 
                
            @endif
        @endforeach
        
        <form action="{{ route('manifest-proses', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button
            type="submit"
            class="btn btn-success btn-small"
            >
            Cetak Tiket
            </button>
        </form>
        <a href="{{ route('home') }}" class="btn btn-success btn-small">
            {{ $booking->order->first()->status }}
        </a>
        
        
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
    
@endpush