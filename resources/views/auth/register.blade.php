@extends('layouts.app')

@push('addon-style')
  <!-- animate CSS-->
  <link href="{{ asset('/assets/css/animate.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="{{ asset('/assets/css/app-style.css') }}" rel="stylesheet"/>
  {{-- animation --}}
  <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
@endpush

@section('content')
<section id="wrapper">
    <div class="card-authentication2 mx-auto my-5 animated" data-animation-type="fadeInDown" data-animation-duration="1" data-animation-delay="0">
	    <div class="card-group">
	    	<div class="card mb-0">
	    	   <div class="bg-signin2"></div>
	    		<div class="card-img-overlay rounded-left my-5">
                 <h2 class="text-white">Berpergian luar kota dengan Bus?</h2>
                 <h1 class="text-white">Gunakan Dipass</h1>
                 <p class="card-text text-white pt-3">Dipass B2C adalah platfrom yang digunakan untuk pemesanan tiket Bus luar kota. Nikmati kemudahan dalam berpergian menggunakan Dipass B2C.</p>
             </div>
	    	</div>

	    	<div class="card mb-0 ">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<div class="text-center">
					 		<img src="{{ asset('/images/logo.png') }}">
					 	</div>
					 <div class="card-title text-uppercase text-center py-3">Register Akun</div>
					   <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="form-control-position">
                                        <i class="soap-icon-user"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="email" class="sr-only">Email ID</label>
                                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="form-control-position">
                                        <i class="soap-icon-message"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    <div class="form-control-position">
                                        <i class="soap-icon-settings"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="position-relative has-icon-left">
                                    <label for="password-confirm" class="sr-only">Retry Password</label>
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retry Password">
                                    <div class="form-control-position">
                                        <i class="soap-icon-settings"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="user-checkbox" checked="" required />
                                    <label for="user-checkbox">I Accept terms & conditions</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-block waves-effect waves-light">Register</button>
                            <div class="text-center pt-3">
                                <hr>
                                <p class="text-muted">Apakah kamu sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('addon-script')
<script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
@endpush
