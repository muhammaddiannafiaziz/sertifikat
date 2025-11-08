@extends('frontend.layout')

@section('title', 'Dashboard')

@section('content')

<!-- Header -->
<header id="header" class="header py-28 text-center md:pt-36 lg:text-left xl:pt-44 xl:pb-32">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2 lg:gap-x-8">
        <div class="mb-7 lg:mt-32 xl:mt-40 xl:mr-12">
            <h1 class="h1-large mb-1">Welcome To</h1>
            <h1 class="h1-large mb-5">TIPD Developer</h1>
            <p class="p-large mb-8">Frontend, Backend, and Fullstack Developer </p>
            <!--<a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Download</a>-->
            <!--<a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Download</a>-->
        </div>
        <div class="xl:text-right">
            <img class="inline" src="images/dev.gif" alt="alternative" />
        </div>
    </div> <!-- end of container -->
</header> <!-- end of header -->
<!-- end of header -->


<!-- Introduction -->
<div class="pt-4 pb-14 text-center">
    <div class="container px-4 sm:px-8 xl:px-4">
        <p class="mb-4 text-gray-800 text-3xl leading-10 lg:max-w-5xl lg:mx-auto">Our Team is Always Ready to Serve You</p>
    </div> <!-- end of container -->
</div>
<!-- end of introduction -->


<!-- Sertifikat -->
<div id="sertifikat" class="cards-1">
    <div class="container px-4 sm:px-8 xl:px-4">

        <!-- Card -->
        <div class="card">
            <div class="card-image">
                <img src="images/features-icon-1.svg" alt="alternative" />
            </div>
            <div class="card-body">
                <h5 class="card-title">Frontend Development</h5>
                <p class="mb-4">You sales force can use the app on any smartphone platform without compatibility issues</p>
            </div>
        </div>
        <!-- end of card -->

        <!-- Card -->
        <div class="card">
            <div class="card-image">
                <img src="images/features-icon-2.svg" alt="alternative" />
            </div>
            <div class="card-body">
                <h5 class="card-title">Backend Development</h5>
                <p class="mb-4">Works smoothly even on older generation hardware due to our optimization efforts</p>
            </div>
        </div>
        <!-- end of card -->

        <!-- Card -->
        <div class="card">
            <div class="card-image">
                <img src="images/features-icon-3.svg" alt="alternative" />
            </div>
            <div class="card-body">
                <h5 class="card-title">Fullstack Development</h5>
                <p class="mb-4">Optimized code and innovative technology insure no delays and ultra-fast responsiveness</p>
            </div>
        </div>
        <!-- end of card -->



    </div> <!-- end of container -->
</div> <!-- end of cards-1 -->
<!-- end of features -->


<!-- Validasi -->
<div id="validasi" class="pt-12 pb-16 lg:pt-16">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-12 lg:gap-x-12">
        <div class="lg:col-span-5">
            <div class="mb-16 lg:mb-0 xl:mt-16">
                <h2 class="mb-6">Our Leader</h2>
                <p class="mb-4">Based on our team's extensive experience in developing line of business applications and constructive customer feedback we reached a new level of revenue.</p>
                <p class="mb-4">We enjoy helping small and medium sized tech businesses take a shot at established Fortune 500 companies</p>
            </div>
        </div> <!-- end of col -->
        <div class="lg:col-span-7">
            <div class="xl:ml-14">
                <img class="inline" src="images/user.avif" alt="alternative" />
            </div>
        </div> <!-- end of col -->
    </div> <!-- end of container -->
</div>
<!-- end of details 1 -->




<!-- Conclusion -->
<div id="download" class="basic-5">
    <div class="container px-4 sm:px-8 lg:grid lg:grid-cols-2">
        <div class="mb-16 lg:mb-0">
            <img src="images/conclusion-smartphone.png" alt="alternative" />
        </div>
        <div class="lg:mt-24 xl:mt-44 xl:ml-12">
            <p class="mb-9 text-gray-800 text-3xl leading-10">Team management mobile applications don’t get much better than Pavo. Download it today</p>
            <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>Download</a>
            <a class="btn-solid-lg secondary" href="#your-link"><i class="fab fa-google-play"></i>Download</a>
        </div>
    </div> <!-- end of container -->
</div> <!-- end of basic-5 -->
<!-- end of conclusion -->

@endsection