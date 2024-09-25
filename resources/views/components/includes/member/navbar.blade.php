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
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('member.course') }}#course">Kursus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#testimonial">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#aboutus">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Kontak Kami</a>
                    </li>
                </ul>
                <hr />
                <div class="r-nav align-items-center gap-2 my-3 my-md-1">
                    <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('member.login') }}">Masuk</a>
                    <a type="button" class="btn btn-signup text-white mt-md-0"
                        href="{{ route('member.register') }}">Daftar</a>
                </div>
            </div>
        </div>
    </nav>
</div>