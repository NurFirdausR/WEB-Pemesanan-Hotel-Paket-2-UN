<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <div class="container p-5">
        <div class="row d-flex justify-content-center">
            <div class="d-flex justify-content-center m-2">
                <h4>HOTEL TRANSYLVANIA</h4>
            </div>
            <div class="card w-75">
                <div class=" d-flex justify-content-end">
                    <span class="m-">{{ Carbon\Carbon::now() }}</span>
                </div>
                <div class="card-body border-rounded">
                    <div class="row">
                        <div class="col-6">
                            <span> Nama Pemesan </span>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-5">
                            <span>{{ $reservasi[0]->nama_pemesan }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span> Email </span>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-5">
                            <span>{{ $reservasi[0]->email }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span> No Telpon </span>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-5">
                            <span>{{ $reservasi[0]->no_telpon }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span> Check in - Check Out </span>
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-5">
                            <span>{{ Carbon\Carbon::parse($reservasi[0]->check_in)->isoFormat('D MMMM Y') }} -
                                {{ Carbon\Carbon::parse($reservasi[0]->check_out)->isoFormat('D MMMM Y') }} </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table text-center ">
                        <thead>
                            <tr>
                                <th>Nama Kamar</th>
                                <th>Tipe Kamar</th>
                                <th>Maks Orang</th>
                                <th>Fasilitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamars as $item)
                                <tr>
                                    <td>{{ $item->nama_kamar }}</td>
                                    <td>{{ $item->tipe_kamar->nama_tipe }}</td>
                                    <td>{{ $item->maks_orang }}</td>
                                    <td>{{ rupiah($item->harga) }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="row">
                        <div class="col-6">
                            Total Harga :
                        </div>
                        <div class="col-6">
                            {{ rupiah($total_harga) }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <!-- Remove the container if you want to extend the Footer to full width. -->
                        <div class="container my-5">
                            <!-- Footer -->
                            <footer class="text-center text-lg-start text-white" style="background-color: #aeb1b7">
                                <!-- Grid container -->
                                <div class="container p-4 pb-0">
                                    <!-- Section: Links -->
                                    <section class="">
                                        <!--Grid row-->
                                        <div class="row">

                                            <!-- Grid column -->
                                            <hr class="w-100 clearfix d-md-none" />

                                            <!-- Grid column -->
                                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                                                <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                                                <p><i class="fas fa-home mr-3"></i>Hotel Transylvania
                                                    Jl. Pisang No.mor 27, Jeppee, Kec. Tanete Riattang Bar., Kabupaten Bone, Sulawesi Selatan 92711</p>
                                                <p><i class="fas fa-envelope mr-3"></i> Hoteltranslvania@hotel.com</p>
                                                <p><i class="fas fa-phone mr-3"></i> + 62 818 567 858</p>
                                                <p><i class="fas fa-print mr-3"></i> + 62 812 567 859</p>
                                            </div>
                                            <!-- Grid column -->
                                        </div>
                                        <!--Grid row-->
                                    </section>
                                    <!-- Section: Links -->

                                    <hr class="my-3">

                                    <!-- Section: Copyright -->
                                    <section class="p-3 pt-0">
                                        <div class="row d-flex align-items-center">
                                            <!-- Grid column -->
                                            <div class="col-md-7 col-lg-8 text-center text-md-start">
                                                <!-- Copyright -->
                                                <div class="p-3">
                                                    © 2022 Copyright:
                                                    <a class="text-white"
                                                        href="https://mdbootstrap.com/">Hoteltranslvania.com</a>
                                                </div>
                                                <!-- Copyright -->
                                            </div>
                                            <!-- Grid column -->


                                        </div>
                                    </section>
                                    <!-- Section: Copyright -->
                                </div>
                                <!-- Grid container -->
                            </footer>
                            <!-- Footer -->
                        </div>
                        <!-- End of .container -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
