@extends('guest.layouts.master')
@section('content')
    <div class="d-flex justify-content-center">
        <iframe class="w-75 " style="border-radius: 20px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.2907585097482!2d120.31547631744385!3d-4.541591299999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbde5ade91548cb%3A0x592d60da036f7619!2sHotel%20Transylvania!5e0!3m2!1sid!2sid!4v1649748524583!5m2!1sid!2sid"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="row m-5 d-flex justify-content-center">
        <div class="card  border-info mb-3 row ">
            <div class="row ">
                <div class="col-lg-4">
                    <div class="card-header" style="background-color:transparent;"><i class="fa-solid fa-phone fa-lg mr-2"></i> Nomor Telpon </div>
                    <div class="card-body text-info">
                        <span>( +62 ) 182944485</span> <br>
                        <span>( +62 ) 8121311226</span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-header" style="background-color:transparent;"><i class="fa-solid fa-map-location fa-lg mr-2"></i> Alamat </div>
                    <div class="card-body text-info">
                        <span>Hotel Transylvania
                            Jl. Pisang No.mor 27, Jeppee, Kec. Tanete Riattang Bar., Kabupaten Bone, Sulawesi Selatan 92711
                        </span>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-header" style="background-color:transparent;"><i class="fa-solid fa-envelope fa-lg mr-2"></i> Email </div>
                    <div class="card-body text-info">
                        <span>HotelTranslvania@hotel.com</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">

                </div>
                <div class="col-lg-6 ">
                    <div class="card-header" style="background-color:transparent;"> Media Contact </div>
                    <div class="container p-4 pb-0">
                        <!-- Section: Social media -->
                        <section class="mb-4">
                            <!-- Facebook -->
                            <a class="btn btn-outline-dark btn-floating m-1" href="https://www.facebook.com/login/?privacy_mutation_token=eyJ0eXBlIjowLCJjcmVhdGlvbl90aW1lIjoxNjQ5NzUwNDAxLCJjYWxsc2l0ZV9pZCI6MjY5NTQ4NDUzMDcyMDk1MX0%3D" role="button"><i
                                    class="fab fa-facebook-f"></i></a>
    
                            <!-- Twitter -->
                            <a class="btn btn-outline-dark btn-floating m-1" href="https://twitter.com/login" role="button"><i
                                    class="fab fa-twitter"></i></a>
    
                            <!-- Instagram -->
                            <a class="btn btn-outline-dark btn-floating m-1" href="https://www.instagram.com/" role="button"><i
                                    class="fab fa-instagram"></i></a>
                                        
                            <!-- Whatsapp -->
                            <a class="btn btn-outline-dark btn-floating m-1" href="https://wa.me/628121311226" role="button"><i
                                class="fab fa-whatsapp"></i></a>
    
                        </section>
                        <!-- Section: Social media -->
                    </div>
                </div>
                <div class="col-lg-3">

                </div>
            </div>

        </div>
        {{-- <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fa-solid fa-map-location fa-lg mr-2"></i> Alamat </div>
                <div class="card-body text-info">
                    <span>Hotel Transylvania
                        Jl. Pisang No.mor 27, Jeppee, Kec. Tanete Riattang Bar., Kabupaten Bone, Sulawesi Selatan 92711
                        </span>
                </div>
              </div>
              <div class="card border-info mb-3" style="max-width: 18rem;">
                <div class="card-header"><i class="fa-solid fa-envelope fa-lg mr-2"></i> Email </div>
                <div class="card-body text-info">
                    <span>HotelTranslvania@hotel.com</span>
                </div>
              </div> --}}
    </div>
@endsection
