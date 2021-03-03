<header id="header" class="navbar-static-top">
    {{-- <div class="topnav hidden-xs">
        <div class="container">
            <ul class="quick-menu pull-left">
                <li><a href="#">My Account</a></li>
            </ul>
            <ul class="quick-menu pull-right">
                <li><a href="#travelo-login" class="soap-popupbox">LOGIN</a></li>
                <li><a href="#travelo-signup" class="soap-popupbox">SIGNUP</a></li>
            </ul>
        </div>
    </div> --}}
    
    <div class="main-header">
        
        <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
            Mobile Menu Toggle
        </a>

        <div class="container">
            <h1 class="navbar-brand">
                <a href="{{ route('home') }}" title="dipassB2C - Home">
                    <img src="{{ asset('/images/logo.png') }}"alt="dipass Logo" />
                </a>
            </h1>

            <nav id="main-menu" role="navigation">
                <ul class="menu">
                    <li class="menu-item-has-children">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="{{ route('bus-list') }}">Bus Kategori</a>
                    </li>
                    @guest  
                        <li>
                            <a href="{{ route('login') }}">LOGIN</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">register</a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a href="{{ route('cart') }}">Order</a>
                        </li>
                        <li>
                            <a>Hi, {{ Auth::user()->name }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endauth
                    
                </ul>
            </nav>
        </div>
        
        <nav id="mobile-menu-01" class="mobile-menu collapse">
            <ul id="mobile-primary-menu" class="menu">
                <li class="">
                    <a href="{{ route('home') }}">Home</a>                    
                </li>
                <li class="">
                    <a href="{{ route('bus-list') }}">Bus Kategori</a>                    
                </li>    
                @guest  
                    <li>
                        <a href="{{ route('login') }}">LOGIN</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">register</a>
                    </li>
                @endguest
                @auth
                    <li>
                        <a href="{{ route('cart') }}">Order</a>
                    </li>
                    <li>
                        <a>Hi, {{ Auth::user()->name }}</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
            
        </nav>
    </div>
</header>