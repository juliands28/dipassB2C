@extends('layouts.app')

@section('title')
    Upload Transfer Pembayaran - dipass-B2C
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
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet"/>     <!--multi select-->
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
            <h2 class="entry-title">Upload Transfer Pembayaran</h2>
        </div>
        <ul class="breadcrumbs pull-right">
            <li><a href="{{ route('home') }}">HOME</a></li>
            <li><a href="{{ url('/checkout/') }}/{{ $order->schedule_id}}">Pemesanan Tiket Bus</a></li>
            <li><a href="{{ url('/checkout/confirm/') }}/{{ $order->id}}">Detail Pesanan</a></li>
            <li class="active">Pembayaran</li>
        </ul>
    </div>
</div>
<section id="content" class="gray-area">
    <div class="container">
        <div class="row">
            <div id="main" class="col-sm-8 col-md-9">
                <div class="booking-information travelo-box">
                    <h2>Konfirmasi Transfer Pemesanan</h2>
                    <hr />
                    <div class="booking-confirmation clearfix">
                        <i class="soap-icon-recommend icon circle"></i>
                        <div class="message">
                            <h4 class="main-message">Order No: {{ $order->order_no }}</h4>
                            <p>Pembayaran menggunakan Transfer</p>
                        </div>
                        <h2 class="print-button text-success">Total Harga : {{ $order->total_price }}</h2>
                    </div>
                    <hr />
                    <h2>Upload bukti transfer Pembayaran</h2>
                    <p>Pembayaran menggunakan dipass B2C melalui Transfer diwajibkan menyertakan bukti transfer pembayaran. Bukti transfer akan kami proses terlebih dahulu untuk mengecek pembayaran anda.</p>
                    <br />
                    {{-- <p class="red-color">Note: sertakan bukti Transfer anda di bawah ini.</p> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($order->payment->upload as $transfer)
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <div class="">
                                        <img
                                            src="{{ Storage::url($transfer->photos ?? '') }}"
                                            alt="Bukti Transfer Dipass"
                                            class="" width="100%"
                                        />
                                        <form action="{{ route('payment-transfer-delete', $transfer->id) }}" id="delete" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $order->id }}" name="order_id">
                                        <a class="delete-gallery" href="javascript:{}" onclick="document.getElementById('delete').submit();"><img src="{{ asset('/images/delete.png') }}" alt="" /></a>
                                        
                                        </form>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                    <dl class="term-description">
                                        <dt>Nama Bank:</dt><dd>{{ $order->payment->upload[0]->bank }}</dd>
                                        <dt>Nama Pengirim:</dt><dd>{{ $order->payment->upload[0]->name }}</dd>
                                        <dt>Nomor Rekening:</dt><dd>{{ $order->payment->upload[0]->no_reg }}</dd>
                                        <dt>Tanggal Transfer:</dt><dd>{{ $order->payment->upload[0]->date->format('F j, Y') }}</dd>
                                    </dl>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-12 mt-3">
                            <div class="card">
                                <div class="card-header text-uppercase">Upload bukti transfer</div>
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="col-12 mt-3">
                                        <form action="{{ route('payment-transfer-upload') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $order->payment->id }}" name="payment_id">
                                        <input type="hidden" value="{{ $order->id }}" name="order_id">
                                        <div class="card-information">
                                            <h2>Your Card Information</h2>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-5">
                                                        <label>Nama Bank</label>
                                                        <div class="selector">
                                                            <select class="full-width" name="bank">
                                                                <option value="Mandiri">Mandiri</option>
                                                                <option value="BCA">BCA</option>
                                                                <option value="BNI">BNI</option>
                                                                <option value="BRI">BRI</option>
                                                                <option value="CIMB">CIMB</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-5">
                                                        <label>Nama Pengirim</label>
                                                        <input type="text" class="input-text full-width" value="" name="name" placeholder="" required/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-5">
                                                        <label>Nomor Rekening</label>
                                                        <input type="number" class="input-text full-width" name="no_reg" value="" placeholder="" required/>
                                                    </div>
                                                    <div class="col-sm-6 col-md-5 mb-5">
                                                        <label>Tanggal Transfer</label>
                                                        <div class="datepicker-wrap">
                                                        <input type="text" name="date" class="input-text full-width" placeholder="Pilih Tanggal" required/>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <input
                                            type="file"
                                            name="photos"
                                            id="file"
                                            style="display: none;"
                                            multiple
                                            onchange="form.submit()"
                                        />
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-block mt-3"
                                            onclick="thisFileUpload()"
                                        >
                                            Simpan & tambah Photo
                                        </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('sukses', $order->id) }}" class="btn float-right btn-success btn-small">
                                selesai
                            </a>
                        </div>
                        {{-- <a href="{{ route('manifest-tiket', $order->id) }}" class="btn pull-right btn-success btn-small">
                            selesai
                        </a> --}}
                        {{-- <form action="{{ route('manifest-proses', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button
                            type="submit"
                            class="btn btn-success btn-small full-width"
                            >
                            tiket
                            </button>
                        </form> --}}
                        <br>
                        <br>
                    </div>
                </div>
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
{{-- calendar --}}
<script type="text/javascript" src="{{ asset('/js/calendar.js') }}"></script>
<!-- load FlexSlider scripts -->
<script type="text/javascript" src="{{ asset('/components/flexslider/jquery.flexslider-min.js') }}"></script>
 <!--Bootstrap Datepicker Js-->
 <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
 <script>
   $('#autoclose-datepicker').datepicker({
     autoclose: true,
     todayHighlight: true,
     format: 'yy/mm/dd'
     
   });
 </script>
<!-- Dropzone JS  -->
<script src="{{ asset('/assets/plugins/dropzone/js/dropzone.js') }}"></script>
<script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>

@endpush