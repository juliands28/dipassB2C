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
                    <li>
                        <a href="#travelo-login" class="soap-popupbox">LOGIN</a>
                    </li>
                    {{-- <li>
                        <a href="#travelo-signup" class="soap-popupbox">SIGNUP</a>
                    </li> --}}
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
                <li>
                    <a href="#travelo-login" class="soap-popupbox">LOGIN</a>
                </li>
                {{-- <li>
                    <a href="#travelo-signup" class="soap-popupbox">SIGNUP</a>
                </li> --}}
            </ul>
            
        </nav>
    </div>
    <div id="travelo-signup" class="travelo-signup-box travelo-box">
        <div class="login-social">
            <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
            <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
        </div>
        <div class="seperator"><label>OR</label></div>
        <div class="simple-signup">
            <div class="text-center signup-email-section">
                <a href="#" class="signup-email"><i class="soap-icon-letter"></i>Sign up with Email</a>
            </div>
            <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund olicy, and Host Guarantee Terms.</p>
        </div>
        <div class="email-signup">
            <form>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="first name">
                </div>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="last name">
                </div>
                <div class="form-group">
                    <input type="text" class="input-text full-width" placeholder="email address">
                </div>
                <div class="form-group">
                    <input type="password" class="input-text full-width" placeholder="password">
                </div>
                <div class="form-group">
                    <input type="password" class="input-text full-width" placeholder="confirm password">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Tell me about Travelo news
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <p class="description">By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms.</p>
                </div>
                <button type="submit" class="full-width btn-medium">SIGNUP</button>
            </form>
        </div>
        <div class="seperator"></div>
        <p>Already a Travelo member? <a href="#travelo-login" class="goto-login soap-popupbox">Login</a></p>
    </div>
    <div id="travelo-login" class="travelo-login-box travelo-box">
        <div class="login-social">
            {{-- <a href="#" class="button login-facebook"><i class="soap-icon-facebook"></i>Login with Facebook</a>
            <a href="#" class="button login-googleplus"><i class="soap-icon-googleplus"></i>Login with Google+</a>
        </div>--}}
        <p class="text-bold">Silakan Log In Akun anda</p><br>
        {{-- <div class="seperator"><label>MASUKAN AKUN ANDA</label></div> <br><br> --}}
        <form>
            <div class="form-group">
                <input type="text" name="email" class="input-text full-width" placeholder="email address">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="input-text full-width" placeholder="password">
            </div>
            <div class="form-group">
                {{-- <a href="#" class="forgot-password pull-right">Forgot password?</a> --}}
                <div class="checkbox checkbox-inline">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
            <button type="submit" class="text-center btn btn-primary">
                Login
            </button>
        </form>
        <div class="seperator"></div>
        <p>Don't have an account? <a href="#travelo-signup" class="goto-signup soap-popupbox">Sign up</a></p>
    </div>
</header>