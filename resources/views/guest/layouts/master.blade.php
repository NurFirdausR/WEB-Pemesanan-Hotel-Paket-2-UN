



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">

        <link rel="stylesheet" href="{{ asset('carousel') }}/css/style.css">
        {{-- navbar     --}}
        <link rel="stylesheet" href="{{asset('navbar')}}/css/style.css">
        {{-- /navbar --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          {{-- font --}}
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
{{-- font --}}


@stack('style')
<style>
    .hotel-font {
      font-family: 'Kaushan Script', cursive;
    }
  </style>

    <title>Tamu</title>
  </head>
  <body style="	overflow-x: hidden; height: 50%">
    <nav class="navbar navbar-light  text-dark">
        <header class="site-navbar site-navbar-target " role="banner">

            <div class="container">
              <div class="row align-items-center position-relative">
    
                <div class="col-3">
                  <div class="site-logo">
                    <a href="{{route('home')}}" style="font-size: 20px;  " class=" font-weight-bold">Hotel Translvania</a>
                  </div>
                </div>
    
                <div class="col-9  text-right">
                  
    
                  <span class="d-inline-block d-lg-none"><a href="#" class="text-primary site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-white"></span></a></span>
    
    
                  <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto ">
                      <li class="{{(request()->is('/')) ? 'active' : ''}}"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                      <li class="{{(request()->is('kamar')) ? 'active' : ''}}"><a href="{{url('kamar')}}" class="nav-link">Kamar</a></li>
                      <li class="{{request()->is('fasilitas') ? 'active' : ''}}"><a href="{{url('fasilitas')}}" class="nav-link">Fasilitas</a></li>
                      <li class="{{request()->is('contact') ? 'active' : ''}}"><a href="{{url('contact')}}" class="nav-link">Contact Us </a></li>
                    </ul>
                  </nav>
                </div>
    
                
              </div>
            </div>
    
          </header>
      </nav>
           
    <div class="container-fluid pt-2">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        {{-- <div class="container"> --}}
           
        {{-- </div> --}}
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="container"  >
            <div class="row pt-5" >
                <div class="col-md-12">
                    
                    
                    @yield('content')


                   
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
                <!-- End Page wrapper  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="text-center text-white" style="background-color: transparent;">
                    <!-- Grid container -->
                    <div class="container p-4">
                        <!-- Section: Images -->
                        <section class="">
                            <div class="row">
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/113.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/111.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/112.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/114.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/115.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 mb-4 mb-md-0">
                                    <div class="bg-image hover-overlay ripple shadow-1-strong rounded"
                                        data-ripple-color="light">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/fluid/city/116.webp"
                                            class="w-100" style="border-radius: 10px;" />
                                        <a href="#!">
                                            <div class="mask"
                                                style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Section: Images -->
                    </div>
                    <!-- Grid container -->

                    <!-- Copyright -->
                    <div class="text-center p-3 text-dark" style="background-color: transparent;">
                        © 2020 Copyright:
                        <a class="text-dark   " href="https://mdbootstrap.com/">Hotel Transylvania</a>
                    </div>
                    <!-- Copyright -->
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
        </div>
    
 
 
 
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
   {{-- axios --}}
   <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   {{-- axios --}}
 
@stack('script')


{{-- navbar     --}}
    {{-- <script src="{{asset('navbar')}}/js/main.js"></script> --}}
   {{-- /navbar --}}

         <!-- for carousel -->
            <!-- <script src="{{ asset('carousel') }}/js/jquery.min.js"></script> -->
            <script src="{{ asset('carousel') }}/js/popper.js"></script>
            <!-- <script src="{{ asset('carousel') }}/js/bootstrap.min.js"></script> -->
            <script src="{{ asset('carousel') }}/js/owl.carousel.min.js"></script>
            <script src="{{ asset('carousel') }}/js/main.js"></script>
            <!-- for carousel -->

         
  </body>
</html>