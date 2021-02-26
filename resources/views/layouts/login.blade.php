<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content="dipass | tiket bus antar kota"/>
  <meta name="author" content="dipass"/>
  <title>@yield('title')</title>
   <!--favicon-->
   <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
  {{-- style awal --}}
  @stack('prepend-style')
  @include('includes.style')
  @stack('addon-style')
  {{-- style akhir --}}
</head>

<body>
    <div id="page-wrapper">
        {{-- navbar --}}
        @include('includes.navbar')
            
        {{-- Page Content --}}
        @yield('content')
        
        {{-- footer awal --}}
        @include('includes.footer')
        {{-- footer akhir --}}
        
        <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    </div>
    
     
	</div><!--wrapper-->


   {{-- javascript awal --}}
   @stack('prepend-script')
   @include('includes.script')
   @stack('addon-script')
   {{-- javascript akhir--}}
  
</body>
</html>
