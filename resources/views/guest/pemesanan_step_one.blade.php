@extends('guest.layouts.master_step')
@push('style')
<link href="{{asset('date_picker')}}/css/t-datepicker.min.css" rel="stylesheet" type="text/css">
<link href="{{asset('date_picker')}}/css/themes/t-datepicker-teal.css" rel="stylesheet" type="text/css">
 
@endpush
@section('step_content')
    <div class="card">
        <div class="card-body">
            <h4>Cek Ketersediaan</h4>
            <form>
                <div class="row">
                    <i class="fa-regular fa-calendar fa-2x mb-2"></i>
                    <div class="form-group">
                        <div class="t-datepicker">
                    
                            <div class="t-check-in"></div>
                            <div class="t-check-out"></div>
                        </div>
                         
                        
                    </div>
                    <div class="row">
                        <div class="col-6">

                            <div class="text-danger d-none" id="check_in">
                                Check in  tidak boleh kosong
                             </div>
                        </div>
                        <div class="col-6">
                            <div class="text-danger d-none" id="check_out">
                                Check out  tidak boleh kosong
                             </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                   <div class="col-4">
                    <div class="form-group">
                        <i class="fa-solid fa-person fa-2x mb-2"></i>
                        <div class="input-group w-75">
                            <select id="jumlah_tamu" class="form-control">
                                <option value="" selected>Jumlah Tamu</option>
                                @for ($i = 1; $i <= 4; $i++)
                                <option value="{{$i}}" {{ $i == session()->get('jumlah_tamu') ? 'selected' : '' }}>{{$i}}</option>
                                    
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Jumlah Tamu tidak boleh koosng
                            </div>
                            
                        </div>
                    </div>
                   </div>
                   <div class="col-4">
                    <div class="form-group">
                        <i class="fa-solid fa-bed fa-2x mb-2"></i>
                        <div class="input-group w-75">
                            <select id="tipe_kamar" class="form-control">
                                <option value="" selected>Pilih Tipe Kamar</option>
                                @foreach ($tipe_kamar_all as $item)
                                    <option value="{{$item->id}}" {{ $item->id == session()->get('tipe_kamar') ? 'selected' : '' }}>{{$item->nama_tipe}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Tipe Kamar tidak boleh koosng
                            </div>
                        </div>
                    </div>
                   </div>

                </div>
             
                    
                  
                   
                   
                <button class="btn btn-primary mt-4" id="next-one">Next</button>
            </form>
        </div>
    </div>
@endsection

@push('script')

<script src="{{asset('date_picker')}}/js/t-datepicker.min.js"></script>
<script>
    $(document).ready(function () {



        $(document).ready(function () {
        $('#next-one').click(function(e) {
                e.preventDefault();
               
                var check_in =    $( "input[name='t-start']" ).val();
                var check_out =   $( "input[name='t-end']" ).val();
                var jumlah_tamu =   $('#jumlah_tamu').val();
                var tipe_kamar =   $('#tipe_kamar').val();
             
         var range_date = $('.t-datepicker').tDatePicker('getDates')
          var range = new Date(range_date[0]).toISOString()+' - '+new Date(range_date[1]).toISOString()
          var date1 = new Date(range_date[0])
          var date2 = new Date(range_date[1])
            var timeDiff = Math.abs(date2.getTime() - date1.getTime())
            var night = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
               

            console.log(check_in,check_out)
                if (!validasi_check_in() && !validasi_check_out() && !validasi_jumlah_tamu()  && !validasi_tipe_kamar()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('pemesanan_step_one.store') }}", {
                             range : range,
                             jumlah_tamu: jumlah_tamu,
                             jumlah_malam: night,
                             tipe_kamar: tipe_kamar
                        }, {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token.content,
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(function(response) {
                            console.log(response)
                            window.location.href="{{route('pemesanan_step_two')}}"

                        })
                        .catch(function(error) {
                            console.log(error)
                            
                        });

                } else {
                    validasi_check_in() 
                    validasi_check_out() 
                    validasi_jumlah_tamu()  
                    validasi_tipe_kamar()
                                                    
                
                };

                function validasi_check_in() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (check_in == 'null') {
                        // $('#check_in_check_out').addClass('is-invalid'); // Ad class is-invalid
                        $('#check_in').removeClass('d-none'); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        // $('#check_in').removeClass('is-invalid').removeClass('is-invalid');
                        $('#check_in').addClass('d-none'); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    console.log(count_erorr.length)
                    return count_erorr.length;
                }
                function validasi_check_out() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (check_out == 'null') {
                        // $('#check_in_check_out').addClass('is-invalid'); // Ad class is-invalid
                        $('#check_out').removeClass('d-none'); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        // $('#check_out').removeClass('is-invalid').removeClass('is-invalid');
                        $('#check_out').addClass('d-none'); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_jumlah_tamu() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!jumlah_tamu) {
                        $('#jumlah_tamu').addClass('is-invalid'); // Ad class is-invalid
                        $('#jumlah_tamu').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#jumlah_tamu').removeClass('is-invalid').removeClass('is-invalid');
                        $('#jumlah_tamu').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_tipe_kamar() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!tipe_kamar) {
                        $('#tipe_kamar').addClass('is-invalid'); // Ad class is-invalid
                        $('#tipe_kamar').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#tipe_kamar').removeClass('is-invalid').removeClass('is-invalid');
                        $('#tipe_kamar').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

              
            });
           
    });




        // $('#next-one').click(function (e) { 
        //     e.preventDefault();
        // //   var range =   $('#reportrange span').text();
        // //   var range =   $('#reportrange span').attr('data-date');
        //   var jumlah_tamu =   $('#jumlah_tamu').val();
        //   var tipe_kamar =   $('#tipe_kamar').val();
        //   var range_date = $('.t-datepicker').tDatePicker('getDates')
        //   var range = new Date(range_date[0]).toISOString()+' - '+new Date(range_date[1]).toISOString()
        //   var date1 = new Date(range_date[0])
        //   var date2 = new Date(range_date[1])
        //     var timeDiff = Math.abs(date2.getTime() - date1.getTime())
        //     var night = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

        
        //   console.log(range,jumlah_tamu,night,tipe_kamar)
        
        //               var token = document.head.querySelector('meta[name="csrf-token"]');
        //               window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

        //             axios.post("{{ route('pemesanan_step_one.store') }}", {
        //                     range: range,
        //                     jumlah_malam: night,
        //                     jumlah_tamu: jumlah_tamu,
        //                     tipe_kamar: tipe_kamar,
                    
        //                 }, {
        //                     headers: {
        //                         'Content-Type': 'application/json',
        //                         'X-CSRF-TOKEN': token.content,
        //                         'X-Requested-With': 'XMLHttpRequest',
        //                     }
        //                 })
        //                 .then(function(response) {
        //                     console.log(response);
        //                     window.location.href="{{route('pemesanan_step_two')}}"
        //                 })
        //                 .catch(function(error) {
        //                     console.log(error)
                         
        //                 });
            
        // });
    });
    $(function(){
        $('.t-datepicker').tDatePicker({
          
// auto close after selection
autoClose        : true,

// animation speed in milliseconds
durationArrowTop : 200,

// the number of calendars
numCalendar    : 2,

// localization
titleCheckIn   : 'Check In',
titleCheckOut  : 'Check Out',
titleToday     : 'Today',
titleDateRange : 'night',
titleDateRanges: 'nights',
titleDays      : [ 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su' ],
titleMonths    : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'Septemper', 'October', 'November', "December"],

// the max length of the title
titleMonthsLimitShow : 3,

// replace moth names
replaceTitleMonths : null,

// e.g. 'dd-mm-yy'
showDateTheme   : null,

// icon options
iconArrowTop : true,
iconDate     : '&#x279C;',
arrowPrev    : '&#x276E;',
arrowNext    : '&#x276F;',
// https://fontawesome.com/v4.7.0/icons/
// iconDate: '<i class="li-calendar-empty"></i><i class="li-arrow-right"></i>',
// arrowPrev: '<i class="fa fa-chevron-left"></i>',
// arrowNext: '<i class="fa fa-chevron-right"></i>',

// shows today title
toDayShowTitle       : true, 

// showss dange range title
dateRangesShowTitle  : true,

// highlights today
toDayHighlighted     : false,

// highlights next day
nextDayHighlighted   : false,

// an array of days
daysOfWeekHighlighted: [0,6],

// custom date format
formatDate      : 'yyyy-mm-dd',

// dateCheckIn: '25/06/2018',  // DD/MM/YY
// dateCheckOut: '26/06/2018', // DD/MM/YY
dateCheckIn  : {!! json_encode($check_in) !!},
dateCheckOut : {!! json_encode($check_out) !!},
startDate    : null,
endDate      : null,

// limits the number of months
limitPrevMonth : 0,
limitNextMonth : 11,

// limits the number of days
limitDateRanges    : 31,

// true -> full days || false - 1 day
showFullDateRanges : false, 

// DATA HOLIDAYS
// Data holidays
fnDataEvent   : null

});
});

</script>
    {{-- <script></script> --}}
@endpush