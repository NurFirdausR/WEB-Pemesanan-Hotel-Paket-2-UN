@extends('layouts.master_admin')
@section('content')
   
<div class="main-content">
    <section class="section">
        <div class="card mt-5">
            <div class="d-flex justify-content-center mt-5">
                <h4>Code Discount</h4>
            </div>
           
            <div class="card-body">
                <button class="btn btn-primary m-3"  data-toggle="modal" data-target="#add_referral">Tambah Referral</button>


                <table class="table table-bordered referral-ajax">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
    <!-- Modal -->
    <div class="modal fade" id="add_referral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tamabah Referral</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-referral">
                        <div class="card-body">
                            {{-- Baris Pertama --}}
                            <div class="row">
                                {{-- Sebelah Kanan --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Nama Referral</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nama" id="nama"
                                                value="">

                                            <div class="invalid-feedback">
                                                Nama Referral tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>

                                   


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Disc</label>
                                        <div class="input-group">
                                            <input min="1" max="100" type="number" class="form-control" name="disc" id="disc"
                                                value="">

                                            <div class="invalid-feedback">
                                                Discount tidak boleh koosng
                                            </div>
                                        </div>
                                    </div>

                                </div>
                               

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="button_disc" type="submit"
                                class="btn btn-success btm-md justify-content-end mr-3 text-dark"
                                style="border-radius: 10px; background: rgb(101, 255, 80);">Tambah</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit  Referral</h5>
                 
                </div>
                <div class="modal-body" id="editBody">

                </div>

            </div>
        </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
    $(document).ready(function () {
        $('#button_disc').click(function(e) {
                e.preventDefault();

                var nama = $('#nama').val();
                var disc = $('#disc').val();
              

                //   console.log(fasilitas.length,!disc)
                if (!validasi_nama() && !validasi_disc()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('referral.store') }}", {
                            nama: $('#nama').val(),
                            disc: $('#disc').val(),
                          
                        }, {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token.content,
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.msg,
                            })
                            $('.referral-ajax').DataTable().ajax.reload(null, false)
                            

                            $('#add_referral').modal('hide')
                            nama: $('#nama').val('')
                            disc: $('#disc').val('')

                        })
                        .catch(function(error) {
                            console.log(error)
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: error.data.msg,
                            })
                        });

                } else {
                    validasi_nama()
                    validasi_disc();
                
                };

                function validasi_nama() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama) {
                        $('#nama').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_disc() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!disc) {
                        $('#disc').addClass('is-invalid'); // Ad class is-invalid
                        $('#disc').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#disc').removeClass('is-invalid').removeClass('is-invalid');
                        $('#disc').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

              
            });

            $(document).on("click", "#delete_referral", function(e) {
                e.preventDefault()
                var referral_id = $(this, 'button').attr('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus Referral?',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("{{ route('referral.delete', '') }}" + "/" + referral_id)

                            .then(function(response) {
                                console.log(response.msg);
                            $('.referral-ajax').DataTable().ajax.reload(null, false)
                                
                                Swal.fire(response.msg, '', 'success')

                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);
                                Swal.fire(error.data.msg, '', 'error')

                            })
                    } else if (result.isDenied) {
                        Swal.fire('Batal Hapus Referral!', '', 'info')
                    }


                    /* Read more about isConfirmed, isDenied below */

                })

            });





            $(document).on("click", "#edit_referral", function(e) {
                e.preventDefault();
                var referral_id = $(this, 'button').attr('data-id');
                console.log(referral_id)
                axios.get("{{ route('referral.edit', '') }}" + "/" + referral_id)
                    .then(function(response) {
                        // handle success
                        // console.log(response.data);
                        $('#editModal').modal("show");
                        $('#editBody').html(response.data).show();
                        $('#button_referral_update').click(function(e) {
                            e.preventDefault();

                            var nama = $('#nama_edit').val();
                            var disc = $('#disc_edit').val();
              

                            //   console.log(fasilitas.length,!no_kamar)
                            if (!validasi_nama() && !validasi_disc()) {
                                var token = document.head.querySelector(
                                    'meta[name="csrf-token"]');
                                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                                axios.put("{{ route('referral.update', '') }}" + "/" + referral_id, {
                                    nama: $('#nama_edit').val(),
                                      disc: $('#disc_edit').val(),
                                    }, {
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token.content,
                                            'X-Requested-With': 'XMLHttpRequest',
                                        }
                                    })
                                    .then(function(response) {

                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: response.msg,
                                        })

                            $('.referral-ajax').DataTable().ajax.reload(null, false)
                                        
                                        $('#editModal').modal('hide')

                                    })
                                    .catch(function(error) {
                                        console.log(error)
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Failed!',
                                            text: error.msg,
                                        })
                                    });

                            } else {
                                validasi_nama()
                    validasi_disc();

                            };
                            function validasi_nama() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama) {
                        $('#nama_edit').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_edit').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_edit').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_edit').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_disc() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!disc) {
                        $('#disc_edit').addClass('is-invalid'); // Ad class is-invalid
                        $('#disc_edit').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#disc_edit').removeClass('is-invalid').removeClass('is-invalid');
                        $('#disc_edit').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                        });

                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                        // alert("Page " + href + " cannot open. Error:" + error);
                    })
            });
    });


        $(function() {

            var table = $('.referral-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('referral.ajax') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'disc',
                        name: 'disc'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });

        });
    </script>
@endpush
