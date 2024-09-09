<!-- NAVBAR -->
<div class="container">
    <nav class="navbar navbar-expand-lg fixed-top bg-white px-5 z-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('nemolab/admin/img/Logo Nemolab.png') }}" alt="Logo" width="100"
                    class="d-inline-block align-text-top">
            </a>
            <div class="menu-toggle d-inline-flex d-lg-none" id="menuToggle">
                <div class="bar1 rounded-3"></div>
                <div class="bar2 rounded-3"></div>
                <div class="bar3 rounded-3"></div>
            </div>
            <div class="navtoggle navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item pt-lg-0 pt-4">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('member.course') }}#course">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#testimonial">Testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Contact Us</a>
                    </li>
                </ul>
                <hr />
                <div class="r-nav align-items-center gap-2 my-3 my-md-1">
                    <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('member.login') }}">Log In</a>
                    <a type="button" class="btn btn-signup text-white mt-md-0"
                        href="{{ route('member.register') }}">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</div>