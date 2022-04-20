@extends('guest.layouts.master')

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- for carousel -->
    <link rel="stylesheet" href="{{ asset('carousel') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('carousel') }}/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="{{ asset('carousel') }}/css/animate.css">
    <!-- /for carousel -->

    {{-- date picker --}}
    <link href="{{ asset('date_picker') }}/css/t-datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('date_picker') }}/css/themes/t-datepicker-teal.css" rel="stylesheet" type="text/css">
    {{-- date picker --}}
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
@endpush
@section('content')
    <div class="slider-hero">
        <div class="featured-carousel owl-carousel">

            @foreach ($kamar as $item)
            <div class="item">
                <div class="work">
                    <div class="img d-flex align-items-center justify-content-center"
                        style="background-image: url({{ asset('kamar_image') }}/{{$item->gambar}});">
                        <div class="text text-center">
                            <h2>{{$item->nama_kamar}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
           
        </div>

        <div class="my-5 text-center">
            <ul class="thumbnail">
               @foreach ($kamar as $item => $value)
               <li class="m-2 {{$item === 0 ? 'active' : ''}} img"><a href="#"><img style="height: 70px; width: 70px;" src="{{ asset('kamar_image') }}/{{$value->gambar}}"  alt="Image"
                class="img-fluid"></a></li>
               @endforeach
               
            </ul>
        </div>

    </div>
    {{-- <form id="pesan"> --}}
    <div class="p-3  d-flex justify-content-center">
        <div class="card shadow p-1 mb-5 bg-white rounded h-25 w-75" style="border-radius:5px;">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="card-body row " style="border-radius: 20px;">
                <div class="col-7">
                    <div class="t-datepicker">
                        <div class="t-check-in"></div>
                        <div class="t-check-out"></div>
                    </div>
                </div>
                <div class="col-2">
                    <select class="form-control" name="jumlah_tamu" id="jumlah_tamu">
                        <option value="" selected>pilih tamu</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>

                </div>

                <div class="col-2">
                    <button id="pesan" class="btn btn-md btn-primary rounded-pill">P E S A N</button>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-4">

                    <div class="text-danger d-none" id="check_in">
                        Check in tidak boleh kosong
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-danger d-none" id="check_out">
                        Check out tidak boleh kosong
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </form> --}}


    <div class="card mb-3 w-100" style="border: none;">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="https://cdn-image.hipwee.com/wp-content/uploads/2021/01/hipwee-hotel-presidente-4s-4.jpg" class="img-fluid rounded-start"
                    style="border-radius: 15px 50px;" alt="...">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title"> Temukan keindahan Bali
                        ayo menginap di hotel kami di pantai indah Bali. </h5>
                    <p class="card-text">

                        Hanya dalam beberapa menit berjalan kaki Anda dapat mencapai tempat wisata sejarah dan pantai. Di sekitar sudut, Anda akan menemukan beberapa toko dan pasar lokal untuk menikmati semua hidangan lokal.

                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 w-100" style="border: none;">
        <div class="row g-0">

            <div class="col-md-7">
                <div class="card-body">
                    <h5 class="card-title"> Semua yang Anda butuhkan untuk menikmati liburan bebas repot Hotel kami menawarkan lebih dari 3 tipe kamar yang berbeda: single, double, junior suite, dan lainnya yang dapat menampung banyak tamu.
                    </h5>
                    <p class="card-text">
                        Semua kamar dilengkapi dengan AC, televisi kabel layar lebar, satu set handuk lembut dan mini bar yang terisi penuh. Para tamu pergi untuk berenang di pantai, yang berada dalam jarak berjalan kaki, atau bersantai di kolam renang hotel. Setiap pagi kami menyajikan sarapan prasmanan yang berlimpah, dengan roti yang baru dipanggang, kue kering, berbagai keju, dan buah-buahan lokal.

                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="https://i0.wp.com/www.cirebonkota.go.id/wp-content/uploads/2021/02/PRIMA.jpg" class="img-fluid rounded-start"
                    style="border-radius: 15px 50px;" alt="...">
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $('#pesan').click(function(e) {
                    e.preventDefault();
                    //   var range =   $('#reportrange span').text();
                    //   var range =   $('#reportrange span').attr('data-date');
                    var jumlah_tamu = $('#jumlah_tamu').val();
                    var range_date = $('.t-datepicker').tDatePicker('getDates')
                    var range = new Date(range_date[0]).toISOString() + ' - ' + new Date(range_date[
                        1]).toISOString()

                    var check_in = $("input[name='t-start']").val();
                    var check_out = $("input[name='t-end']").val();
                    console.log(range, jumlah_tamu)
                    if (!validasi_check_in() && !validasi_check_out()) {

                        var token = document.head.querySelector('meta[name="csrf-token"]');
                        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                        axios.post("{{ route('pesan.store') }}", {
                                range: range,
                                jumlah_tamu: jumlah_tamu

                            }, {
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': token.content,
                                    'X-Requested-With': 'XMLHttpRequest',
                                }

                            })
                            .then(function(response) {
                                console.log(response.data.msg)
                                window.location.href = "{{ route('pemesanan_step_one') }}"
                            })
                            .catch(function(error) {
                                console.log(error)

                            });
                    } else {
                        validasi_check_in()
                        validasi_check_out()



                    };

                    function validasi_check_in() {
                        // buat ngitung ada berapa yang kena validasi
                        count_erorr = [];
                        if (check_in == 'null') {
                            // $('#check_in_check_out').addClass('is-invalid'); // Ad class is-invalid
                            $('#check_in').removeClass(
                            'd-none'); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                            count_erorr += 1
                        } else {
                            // $('#check_in').removeClass('is-invalid').removeClass('is-invalid');
                            $('#check_in').addClass(
                            'd-none'); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                        }
                        console.log(count_erorr.length)
                        return count_erorr.length;
                    }

                    function validasi_check_out() {
                        // buat ngitung ada berapa yang kena validasi
                        count_erorr = [];
                        if (check_out == 'null') {
                            // $('#check_in_check_out').addClass('is-invalid'); // Ad class is-invalid
                            $('#check_out').removeClass(
                            'd-none'); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                            count_erorr += 1
                        } else {
                            // $('#check_out').removeClass('is-invalid').removeClass('is-invalid');
                            $('#check_out').addClass(
                            'd-none'); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                        }
                        // return panjang dari collection atau array
                        return count_erorr.length;
                    }



                });
            });







        });
    </script>

    <!-- for carousel -->
    {{-- <!-- <script src="{{ asset('carousel') }}/js/jquery.min.js"></script> --> --}}
    <script src="{{ asset('carousel') }}/js/popper.js"></script>
    {{-- <!-- <script src="{{ asset('carousel') }}/js/bootstrap.min.js"></script> --> --}}
    <script src="{{ asset('carousel') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('carousel') }}/js/main.js"></script>
    <!-- for carousel -->

    {{-- moment --}}
    {{-- <script src="{{ asset('js') }}/moment.js"></script>
            <script src="{{ asset('js') }}/moment-with-locales.js"></script> --}}
    {{-- moment --}}

    {{-- //date-range --}}
    {{-- <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/> --}}
    {{-- //date-range --}}

    <script src="{{ asset('date_picker') }}/js/t-datepicker.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.t-datepicker').tDatePicker({

                // auto close after selection
                autoClose: true,

                // animation speed in milliseconds
                durationArrowTop: 200,

                // the number of calendars
                numCalendar: 2,

                // localization
                titleCheckIn: 'Check In',
                titleCheckOut: 'Check Out',
                titleToday: 'Today',
                titleDateRange: 'night',
                titleDateRanges: 'nights',
                titleDays: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                titleMonths: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                    'Septemper', 'October', 'November', "December"
                ],

                // the max length of the title
                titleMonthsLimitShow: 3,

                // replace moth names
                replaceTitleMonths: null,

                // e.g. 'dd-mm-yy'
                showDateTheme: null,

                // icon options
                iconArrowTop: true,
                iconDate: '&#x279C;',
                arrowPrev: '&#x276E;',
                arrowNext: '&#x276F;',
                // https://fontawesome.com/v4.7.0/icons/
                // iconDate: '<i class="li-calendar-empty"></i><i class="li-arrow-right"></i>',
                // arrowPrev: '<i class="fa fa-chevron-left"></i>',
                // arrowNext: '<i class="fa fa-chevron-right"></i>',

                // shows today title
                toDayShowTitle: true,

                // showss dange range title
                dateRangesShowTitle: true,

                // highlights today
                toDayHighlighted: false,

                // highlights next day
                nextDayHighlighted: false,

                // an array of days
                daysOfWeekHighlighted: [0, 6],

                // custom date format
                formatDate: 'yyyy-mm-dd',

                // dateCheckIn: '25/06/2018',  // DD/MM/YY
                // dateCheckOut: '26/06/2018', // DD/MM/YY
                dateCheckIn: null,
                dateCheckOut: null,
                startDate: null,
                endDate: null,

                // limits the number of months
                limitPrevMonth: 0,
                limitNextMonth: 11,

                // limits the number of days
                limitDateRanges: 31,

                // true -> full days || false - 1 day
                showFullDateRanges: false,

                // DATA HOLIDAYS
                // Data holidays
                fnDataEvent: null

            });
        });
    </script>
@endpush
