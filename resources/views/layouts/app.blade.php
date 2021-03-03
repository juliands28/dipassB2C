<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html> <!--<![endif]-->
<head>
    <!-- Page Title -->
    <title>@yield('title')</title>
    
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="dipass B2C Bus" />
    <meta name="description" content="dipass | tiket bus antar kota">
    <meta name="author" content="Dipass">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--favicon-->
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
    
    {{-- style awal --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
    {{-- style akhir --}}
    
    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->
    
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->

    
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
    </div>


    {{-- javascript awal --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
    {{-- javascript akhir--}}
</body>
</html>

