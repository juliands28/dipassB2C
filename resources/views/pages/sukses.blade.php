@extends('layouts.app')

@section('title')
    Pesanan Sukses - dipass-B2C
@endsection

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
<div class="section-success d-flex align-items-center mb-5">
    <div class="col text-center">
        <img class="mt-4" src="{{ asset('/images/header1.jpg') }}" alt="Pesan">
        <h1 class="mt-5">Yay! Success</h1>
        <p>
            We've Sent Email for trip instruction
            <br>
            Please read it as well
        </p>
        <a href="{{ route('home') }}" class="btn btn-success btn-small">
            Home Page
        </a>
    </div>
</div>
@endsection

@push('addon-script')
{{-- calendar --}}
<script type="text/javascript" src="{{ asset('/js/calendar.js') }}"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
    
@endpush