<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description" content="Pavo is a mobile app Tailwind CSS HTML template created to help you present benefits, features and information about mobile apps in order to convince visitors to download them" />
    <meta name="author" content="Your name" />

    <meta property="og:site_name" content="" />
    <meta property="og:site" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta name="twitter:card" content="summary_large_image" />

    <title>Aplikasi Sertifikat | UIN Raden Mas Said Surakarta</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/icon-uin.png') }}" />
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->
    <nav class="navbar fixed-top">
        <div class="container sm:px-4 lg:px-8 flex flex-wrap items-center justify-between lg:flex-nowrap">
            <!-- Logo -->
            <a class="inline-block mr-4 py-0.5 text-xl whitespace-nowrap hover:no-underline focus:no-underline" href="{{ route('welcome')}}">
                <img src="{{ asset('images/icon-hor.png') }}" alt="alternative" class="h-8" style="height: 3rem;
" />
            </a>

            <button class="background-transparent rounded text-xl leading-none hover:no-underline focus:no-underline lg:hidden lg:text-gray-400" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon inline-block w-8 h-8 align-middle"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse lg:flex lg:flex-grow lg:items-center" id="navbarsExampleDefault">
                <ul class="pl-0 mt-3 mb-2 ml-auto flex flex-col list-none lg:mt-0 lg:mb-0 lg:flex-row">
                    <li><a class="nav-link page-scroll" href="{{ route('welcome') }}">Home</a></li>
                    <li><a class="nav-link page-scroll" href="{{ route('public.cek') }}">Sertifikat</a></li>
                    <li><a class="nav-link page-scroll" href="https://lens.google.com">Validasi</a></li>
                    <!-- <li><a class="nav-link page-scroll" href="{{ route('login') }}">Login</a></li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Main -->
    @yield('content')

    <!-- Copyright -->
    <div class="footer">
        <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-3">
            <ul class="mb-4 list-unstyled p-small">
                <li class="mb-2"><a href="article.html">Aplikasi Sertifikat</a></li>
            </ul>
            <p class="pb-2 p-small statement">Copyright © <a href="#your-link" class="no-underline">UPT TIPD UIN Raden Mas Said Surakarta</a></p>
            <p class="pb-2 p-small statement">Supported by :<a href="https://themewagon.com/" class="no-underline">Tipd Developer</a></p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    <!-- JavaScript to handle active class on menu click -->
    <script>
        // JavaScript to add "active" class on the clicked menu
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(item => item.classList.remove('active')); // Remove active class from all
                this.classList.add('active'); // Add active class to the clicked link
            });
        });
    </script>

</body>

</html>