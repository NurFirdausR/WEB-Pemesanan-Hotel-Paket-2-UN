@extends('layouts.master_resepsionis')
@push('css')
@endpush
@section('content')
    {{-- <div class="section-header">
    <h1>Top Navigation</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item"><a href="#">Layout</a></div>
      <div class="breadcrumb-item">Top Navigation</div>
    </div>
  </div> --}}
  
    <div class="section-body" style="margin-top: -60px;">
        <h2 class="section-title">Dashboard Resepsionis</h2>
        <p class="section-lead">Untuk Management System </p>
        <div class="card">
            <div class="container">
                <div class="row mt-2 ">
                    <div class="col-6">
                        <input type="date" class="form-control" id="start_date">
                    </div>
                    <div class="col-6">
                        <input type="date" class="form-control" id="end_date">
                    </div>
                </div>
                <button class="btn btn-md m-2 btn-primary" id="filter">Filter</button>
                <button class="btn btn-md m-2 btn-secondary" id="refresh">Refresh</button>
            </div>
            <div class="card-header">
                <h4>Reservasi</h4>
            </div>
            {{-- <div class="row ml-5">
              <div class="col-md-4 form-group" >
                  <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="input-sm form-control" name="start" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />
                      <span class="input-group-addon">to</span>
                      <input type="text" class="input-sm form-control" name="end" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}"/>
                  </div>
                  <button type="button" id="dateSearch" class="btn btn-sm btn-primary">Search</button>
              </div>
          </div> --}}
            <div class="card-body">
                <table class="table table-bordered resepsionis-reservasi-ajax">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tamu</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer bg-whitesmoke">
        This is card footer
      </div> --}}
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Kamar</h4>
            </div>
            {{-- <div class="row ml-5">
              <div class="col-md-4 form-group" >
                  <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="input-sm form-control" name="start" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" />
                      <span class="input-group-addon">to</span>
                      <input type="text" class="input-sm form-control" name="end" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}"/>
                  </div>
                  <button type="button" id="dateSearch" class="btn btn-sm btn-primary">Search</button>
              </div>
          </div> --}}
            <div class="card-body">
                <table class="table table-bordered resepsionis-kamar-ajax">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kamar</th>
                            <th>Status</th>
                            <th>Nama Pemesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            {{-- <div class="card-footer bg-whitesmoke">
        This is card footer
      </div> --}}
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", "#checkin_reservasi", function(e) {
                e.preventDefault()
                var code_reservasi = $(this, 'button').attr('data-id');
                console.log(code_reservasi)

                var token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                axios.put("{{ route('reservasi.checkin', '') }}" + "/" + code_reservasi, {
                        'code_reservasi': code_reservasi
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token.content,
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(function(response) {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.data.msg,
                        })

                        $('.resepsionis-reservasi-ajax').DataTable().ajax.reload(null, false)
                        $('.resepsionis-kamar-ajax').DataTable().ajax.reload(null, false)

                    })
                    .catch(function(error) {
                        console.log(error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: error.data.msg,
                        })
                    });


            });
            $(document).on("click", "#checkout_reservasi", function(e) {
                e.preventDefault()
                var code_reservasi = $(this, 'button').attr('data-id');
                console.log(code_reservasi)

                var token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                axios.put("{{ route('reservasi.checkout', '') }}" + "/" + code_reservasi, {
                        'code_reservasi': code_reservasi
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token.content,
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(function(response) {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.data.msg,
                        })

                        $('.resepsionis-reservasi-ajax').DataTable().ajax.reload(null, false)
                        $('.resepsionis-kamar-ajax').DataTable().ajax.reload(null, false)


                    })
                    .catch(function(error) {
                        console.log(error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: error,
                        })
                    });


            });

            $(document).on("click", "#download_pdf", function(e) {
                e.preventDefault()
                var reservasi_id = $(this, 'button').attr('data-id');
                console.log(reservasi_id)

                axios({
                    url: "{{ route('reservasi.pdf', '') }}" + "/" + reservasi_id,
                    method: 'GET',
                    responseType: 'arraybuffer', // <--
                }).then(response => {
                    console.log(response)
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Berhasil!',
                    })

                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');

                    link.href = url;
                    link.setAttribute('download', 'Reservasi.pdf'); // set custom file name
                    document.body.appendChild(link);
                    link.click(); // force download file without open new tab

                    location.reload();
                });




            });











            $(document).on("click", "#cancel", function(e) {
                e.preventDefault()
                var kamar_id = $(this, 'button').attr('data-id');
                var kamar_code = $(this, 'button').attr('data-code');
                console.log(kamar_id)

                var token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                axios.put("{{ route('resepsionis.cancel', '') }}" + "/" + kamar_id, {
                        'kamar_code': kamar_code
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token.content,
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(function(response) {
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.data.msg,
                        })

                        $('.resepsionis-kamar-ajax').DataTable().ajax.reload(null, false)
                        $('.resepsionis-reservasi-ajax').DataTable().ajax.reload(null, false)

                    })
                    .catch(function(error) {
                        console.log(error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: error,
                        })
                    });


            });
            $(document).on("click", "#filter", function(e) {
                e.preventDefault()
                var start_date = $('#start_date').val();
                var end_date = $('#end_date').val();

                if (start_date != '' && end_date != '') {
                    $('.resepsionis-reservasi-ajax').DataTable().destroy();
                    load_data(start_date,end_date)
                }else{
                    alert('Tidak boleh kosong')
                }
            });
            $(document).on("click", "#refresh", function(e) {
                e.preventDefault();
                 $('#start_date').val('');
                 $('#end_date').val('');
                 $('.resepsionis-reservasi-ajax').DataTable().destroy();
                    load_data();
            });
            

        
          

          

        });

        load_data();
        // $(function() {

            // var table = $('.resepsionis-reservasi-ajax').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: "{{ route('resepsionis.reservasi.ajax') }}",
            //     columns: [{
            //             data: 'DT_RowIndex',
            //             name: 'DT_RowIndex'
            //         },
            //         {
            //             data: 'nama_pemesan',
            //             name: 'nama_pemesan'
            //         },
            //         {
            //             data: 'check_in',
            //             name: 'check_in'
            //         },
            //         {
            //             data: 'check_out',
            //             name: 'check_out'
            //         },
            //         {
            //             data: 'status',
            //             name: 'status'
            //         },
            //         {
            //             data: 'action',
            //             name: 'action',
            //             orderable: true,
            //             searchable: true
            //         },
        // }

            //     ]
            // });



            var table = $('.resepsionis-kamar-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('resepsionis.kamar.ajax') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kamar',
                        name: 'nama_kamar'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'pemesan',
                        name: 'pemesan'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });



        function load_data(start_date = '', end_date = '') {
            var table = $('.resepsionis-reservasi-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("resepsionis.reservasi.ajax") }}',
                    data: {start_date:start_date, end_date:end_date}
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_pemesan',
                        name: 'nama_pemesan'
                    },
                    {
                        data: 'check_in',
                        name: 'check_in'
                    },
                    {
                        data: 'check_out',
                        name: 'check_out'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });
        }
    </script>
@endpush
