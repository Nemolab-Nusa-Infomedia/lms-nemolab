<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/navbar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/footer.css') }} ">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('nemolab/member/img/nemolab.ico') }}" type="image/x-icon">
    @stack('addon-script')
</head>

<body>
    <header>
        @if (Auth::check())
            @include('components.includes.member.navbar-auth')
        @else
            @include('components.includes.member.navbar')
        @endif
    </header>

    <div id="content">
        {{-- content --}}
        @yield('content')
    </div>
    @include('components.includes.member.footer')

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

    @stack('prepend-script')
    <script src="{{ asset('nemolab/components/admin/js/profile-navbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('menuToggle').addEventListener('click', function() {
            this.classList.toggle('on');
            document.getElementById('navbarContent').classList.toggle('show');
        });


        const navLink = document.querySelectorAll('.nav-link');
        var hash = window.location.hash.substr(1);

        if (window.location.pathname == "/member/course") {
            navLink[1].classList.add('active');
            functionCheckActive();
        } else {
            if (hash != '') {
                functionCheckActive();
            } else {
                navLink[0].classList.add('active');
                functionCheckActive();
            }
        }

        function functionCheckActive() {
            if (hash == 'home') {
                navLink[0].classList.add('active');
            } else if (hash == 'course') {
                navLink[1].classList.add('active')
            } else if (hash == 'aboutus') {
                navLink[2].classList.add('active')
            } else if (hash == 'contactus') {
                navLink[3].classList.add('active')
            }

            navLink.forEach(element => {
                element.addEventListener('click', (e) => {
                    navLink.forEach(nav => nav.classList.remove('active'));
                    e.target.classList.add('active');
                })
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Get all sections with an ID attribute
            const sections = document.querySelectorAll('section[id]');
            // Get all nav links
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            function activateNavLink() {
                let currentSection = '';

                // Loop through each section to find which one is in the viewport
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    if (window.scrollY >= sectionTop - sectionHeight / 3) {
                        currentSection = section.getAttribute('id');
                    }
                });

                // Remove active class from all nav links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    // Add active class to the link corresponding to the current section
                    if (link.getAttribute('href').includes(currentSection)) {
                        link.classList.add('active');
                    }
                });
            }

            // Initial call to set the correct nav link on load
            activateNavLink();
            // Add scroll event listener
            window.addEventListener('scroll', activateNavLink);
        });
    </script>
    @stack('addon-script')

</body>

</html>
