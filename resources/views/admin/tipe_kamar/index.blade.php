@extends('layouts.master_admin')
@section('content')


<div class="main-content">
    <section class="section">
        <div class="card mt-5">
            <div class="d-flex justify-content-center mt-5">
                <h4>Tipe Kamar</h4>
            </div>
           
            <div class="card-body">
                <button class="btn btn-primary m-3"  data-toggle="modal" data-target="#add_tipe_kamar">Tambah Tipe Kamar</button>
      
          <table class="table caption-top tipe-kamar-ajax">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Tipe</th>
                      <th>Keterangan</th>
                      <th>Luas</th>
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
   <div class="modal fade" id="add_tipe_kamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tipe Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-tipe-kamar">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Tipe</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nama_tipe" id="nama_tipe"
                                            value="">

                                        <div class="invalid-feedback">
                                            Nama Tipe tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Luas Kamar</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="luas" id="luas"
                                            value="">

                                        <div class="invalid-feedback">
                                            Luas Kamar tidak boleh koosng
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keterangan Tipe Kamar</label>
                                    <div class="input-group">
                                        <textarea class="form-control h-25" name="keterangan" id="keterangan" cols="50" rows="6"></textarea>
                                    
                                        <div class="invalid-feedback">
                                            Keterangan tidak boleh kosong
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="button_tipe_kamar" type="submit"
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Tipe Kamar</h5>
             
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
    $('#button_tipe_kamar').click(function(e) {
                e.preventDefault();

                var nama_tipe = $('#nama_tipe').val();
                var luas = $('#luas').val();
                var keterangan = $('#keterangan').val();
              

                //   console.log(fasilitas.length,!luas)
                if (!validasi_nama_tipe() && !validasi_luas() && !validasi_keterangan()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('tipe_kamar.store') }}", {
                            nama_tipe: $('#nama_tipe').val(),
                            luas: $('#luas').val(),
                            keterangan: $('#keterangan').val(),
                          
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
                                text: response.data.msg,
                            })
                                          $('.tipe-kamar-ajax').DataTable().ajax.reload(null, false)
                 

                            $('#add_tipe_kamar').modal('hide')
                            nama_tipe: $('#nama_tipe').val('')
                            luas: $('#luas').val('')

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
                    validasi_nama_tipe()
                    validasi_luas();
                    validasi_keterangan();
                
                };

                function validasi_nama_tipe() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama_tipe) {
                        $('#nama_tipe').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_tipe').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_tipe').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_tipe').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_luas() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!luas) {
                        $('#luas').addClass('is-invalid'); // Ad class is-invalid
                        $('#luas').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#luas').removeClass('is-invalid').removeClass('is-invalid');
                        $('#luas').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_keterangan() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!keterangan) {
                        $('#keterangan').addClass('is-invalid'); // Ad class is-invalid
                        $('#keterangan').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#keterangan').removeClass('is-invalid').removeClass('is-invalid');
                        $('#keterangan').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

              
            });


            $(document).on("click","#delete_tipe_kamar",function(e) {
            e.preventDefault()
            var tipe_kamar_id = $(this,'button').attr('data-id');

            Swal.fire({
            title: 'Yakin ingin menghapus Tipe Kamar?',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete("{{route('tipe_kamar.delete', '')}}"+"/"+tipe_kamar_id)

                    .then(function (response) {
                        console.log(response);
                        //  $('.tipe-kamar-ajax').DataTable().ajax.reload(null, false)
                        // Swal.fire(response.data.msg, '', 'success')

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                        
                    Swal.fire(error.data.msg, '', 'error')

                    })
                } else if (result.isDenied) {
                    Swal.fire('Batal Hapus Tipe Kamar!', '', 'info')
                }

               
            /* Read more about isConfirmed, isDenied below */
         
            })

            });




            $(document).on("click", "#edit_tipe_kamar", function(e) {
                e.preventDefault();
                var kamar_id = $(this, 'button').attr('data-id');
                console.log(kamar_id)
                axios.get("{{ route('tipe_kamar.edit', '') }}" + "/" + kamar_id)
                    .then(function(response) {
                        // handle success
                        // console.log(response.data);
                        $('#editModal').modal("show");
                        $('#editBody').html(response.data).show();
                        $('#button_tipe_kamar_update').click(function(e) {
                            e.preventDefault();

                            var nama_tipe_edit = $('#nama_tipe_edit').val();
                            var luas_edit = $('#luas_edit').val();
                            var keterangan_edit = $('#keterangan_edit').val();
              

                            //   console.log(fasilitas.length,!no_kamar)
                            if (!validasi_nama_tipe() && !validasi_luas() && !validasi_keterangan()) {
                                var token = document.head.querySelector(
                                    'meta[name="csrf-token"]');
                                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                                axios.put("{{ route('tipe_kamar.update', '') }}" + "/" + kamar_id, {
                                    nama_tipe: $('#nama_tipe_edit').val(),
                                      luas: $('#luas_edit').val(),
                                      keterangan: $('#keterangan_edit').val(),
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
                                            text: response.data.msg,
                                        })

                                          $('.tipe-kamar-ajax').DataTable().ajax.reload(null, false)
                             
                                        $('#editModal').modal('hide')

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
                                validasi_nama_tipe()
                    validasi_luas();
                    validasi_keterangan();

                            };
                            function validasi_nama_tipe() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama_tipe_edit) {
                        $('#nama_tipe_edit').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_tipe_edit').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_tipe_edit').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_tipe_edit').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_luas() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!luas_edit) {
                        $('#luas_edit').addClass('is-invalid'); // Ad class is-invalid
                        $('#luas_edit').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#luas_edit').removeClass('is-invalid').removeClass('is-invalid');
                        $('#luas_edit').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_keterangan() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!keterangan_edit) {
                        $('#keterangan_edit').addClass('is-invalid'); // Ad class is-invalid
                        $('#keterangan_edit').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#keterangan_edit').removeClass('is-invalid').removeClass('is-invalid');
                        $('#keterangan_edit').closest('div').find('.invalid-feedback').addClass(
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
    $(function () {
      
      var table = $('.tipe-kamar-ajax').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('tipe_kamar.ajax') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'nama_tipe', name: 'nama_tipe'},
              {data: 'keterangan', name: 'keterangan'},
              {data: 'luas', name: 'luas'},
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