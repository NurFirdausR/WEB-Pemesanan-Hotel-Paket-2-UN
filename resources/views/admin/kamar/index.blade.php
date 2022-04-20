@extends('layouts.master_admin')
@push('style')
<style>
        #img-preview {
    display: none;
    width: 400px;
    border: 2px dashed #333;  
    margin-bottom: 20px;
  }
  #img-preview img {
    width: 100%;
    height: 80%;
    display: block;
  }
</style>
@endpush
@section('content')

<div class="main-content">
    <section class="section">
        <div class="card mt-5">
            <div class="d-flex justify-content-center mt-5">
                <h4>Kamar</h4>
            </div>
           
            <div class="card-body">
                <button class="btn btn-primary m-3" data-toggle="modal" data-target="#add_kamar">Tambah Kamar</button>

                <table class="table caption-top kamar-ajax">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kamar</th>
                            <th>Gambar Kamar</th>
                            <th>Status</th>
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
    <div class="modal fade" id="add_kamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="heading_modal">Tambah Kamar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form id="form-kamar">
                            <div class="card-body">
                                {{-- Baris Pertama --}}
                                <div class="row">
                                    {{-- Sebelah Kanan --}}
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Nama Kamar</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="nama_kamar" id="nama_kamar"
                                                    value="">

                                                <div class="invalid-feedback">
                                                    Nama Kamar tidak boleh kosong
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>No Kamar</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_kamar" id="no_kamar"
                                                    value="">

                                                <div class="invalid-feedback">
                                                    Nomor Kamar tidak boleh koosng
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Maks Orang</label>
                                            <div class="input-group">
                                                    <select class="form-control" name="maks_orang" id="maks_orang">
                                                        <option value="" selected>Pilih Maks Orang</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>

                                                <div class="invalid-feedback">
                                                    Maks Orang tidak boleh koosng
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tipe Kamar</label>
                                            <div class="input-group">
                                                <select style="font-size: 15px; font-weight: 600;" name="tipe_kamar"
                                                    id="tipe_kamar" class="form-control col-md-12">
                                                    <option style="font-size: 15px; font-weight: 600;" value="" selected>
                                                        --Pilihan--</option>
                                                    @foreach ($tipe_kamar as $item)
                                                        <option style="font-size: 15px; font-weight: 600;"
                                                            value="{{ $item->id }}"
                                                            {{ old('tipe_kamar') == "$item->nama_tipe" ? 'selected' : '' }}>
                                                            {{ $item->nama_tipe }} Luas: {{ $item->luas }}</option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">
                                                    Tipe Kamar tidak boleh koosng
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Harga</label>
                                            <div class="input-group">
                                                <input min="1"  type="number" class="form-control"
                                                    name="harga" id="harga" value="">

                                                <div class="invalid-feedback">
                                                    Harga tidak boleh kosong
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Fasilitas</label>
                                            <div class="input-group">
                                                <select style="font-size: 15px; font-weight: 600;"
                                                    class="form-control col-md-12 " name="fasilitas[]" id="fasilitas"
                                                    multiple="multiple">

                                                    @foreach ($fasilitas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_fasilitas }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <div class="invalid-feedback">
                                                    Fasilitas tidak boleh koosng
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Gambar Fasilitas</label>
                                            <div class="input-group">
                                                     <input class="form-control" type="file" id="gambar" name="gambar">
                                                <div class="invalid-feedback">
                                                    Gambar tidak boleh kosong
                                                </div>
                                                <div class="requirement invalid-feedback">
                                                    Gambar harus jpg,png ,jpeg
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div id="img-preview"></div>
                                    </div>
                                    <input hidden type="text" class="form-control" name="kamar_id" id="kamar_id" value="">


                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="button_kamar" type="submit"
                                    class="btn btn-success btm-md justify-content-end mr-3 text-dark"
                                    style="border-radius: 10px; background: rgb(101, 255, 80);">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>





    <div class="modal fade" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit  Kamar</h5>
                 
                </div>
                <div class="modal-body" id="editBody">

                </div>

            </div>
        </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>

    </script>
    <script type="text/javascript">
        $(document).ready(function() {


            $('#fasilitas').select2();


            $('#button_kamar').click(function(e) {
                e.preventDefault();

                var nama_kamar = $('#nama_kamar').val();
                var no_kamar = $('#no_kamar').val();
                var maks_orang = $('#maks_orang').val();
                var tipe_kamar = $('#tipe_kamar').val();
                var harga = $('#harga').val();
                //   var fasilitas = $("[name='fasilitas[]']").val();
                var fasilitas = $("#fasilitas").val();
                var gambar = $('#gambar').val();

                let formData = new FormData()
                formData.append('nama_kamar', nama_kamar);
                formData.append('no_kamar', no_kamar);
                formData.append('maks_orang', maks_orang);
                formData.append('tipe_kamar', tipe_kamar);
                formData.append('harga', harga);
                formData.append('fasilitas', fasilitas);
                formData.append('gambar', document.getElementById('gambar').files[0]);

                //   console.log(fasilitas.length,!no_kamar)
                if (!validasi_nama_kamar() && !validasi_no_kamar() && !validasi_maks_orang() && !
                    validasi_tipe_kamar() && !validasi_fasilitas() && !validasi_gambar() && !validasi_harga()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('kamar.store') }}",formData, {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token.content,
                                // 'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(function(response) {
                            console.log(response)
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.data.msg,
                            })
                            
                            $('#add_kamar').modal('hide')
                            nama_kamar: $('#nama_kamar').val('');
                            no_kamar: $('#no_kamar').val('');
                            maks_orang: $('#maks_orang').val('');
                            harga: $('#harga').val('');
                            tipe_kamar: $('#tipe_kamar').val('');
                            fasilitas: $("#fasilitas").val([]).change();
                            gambar: $("#gambar").val('');
                            $('.kamar-ajax').DataTable().ajax.reload(null, false)
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
                    validasi_nama_kamar()
                    validasi_no_kamar();
                    validasi_maks_orang();
                    validasi_tipe_kamar();
                    validasi_fasilitas();
                    validasi_gambar();
                    validasi_harga();
                };

                function validasi_nama_kamar() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama_kamar) {
                        $('#nama_kamar').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_kamar').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_kamar').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_kamar').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_no_kamar() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!no_kamar) {
                        $('#no_kamar').addClass('is-invalid'); // Ad class is-invalid
                        $('#no_kamar').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#no_kamar').removeClass('is-invalid').removeClass('is-invalid');
                        $('#no_kamar').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_maks_orang() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!maks_orang) {
                        $('#maks_orang').addClass('is-invalid'); // Ad class is-invalid
                        $('#maks_orang').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#maks_orang').removeClass('is-invalid').removeClass('is-invalid');
                        $('#maks_orang').closest('div').find('.invalid-feedback').addClass(
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

                function validasi_fasilitas() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (fasilitas.length == 0) {
                        $('#fasilitas').addClass('is-invalid'); // Ad class is-invalid
                        $('#fasilitas').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#fasilitas').removeClass('is-invalid').removeClass('is-invalid');
                        $('#fasilitas').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_harga() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (harga.length == 0) {
                        $('#harga').addClass('is-invalid'); // Ad class is-invalid
                        $('#harga').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#harga').removeClass('is-invalid').removeClass('is-invalid');
                        $('#harga').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_gambar() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!gambar) {
                        $('#gambar').addClass('is-invalid'); // Ad class is-invalid
                        $('#gambar').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    }else if(gambar.split('.').pop() != 'png' && gambar.split('.').pop() != 'jpg' && gambar.split('.').pop() != 'jpeg') {
                        $('#gambar').addClass('is-invalid'); // Ad class is-invalid
                        $('#gambar').closest('div').find('.requirement').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    }else {
                        $('#gambar').removeClass('is-invalid').removeClass('is-invalid');
                        $('#gambar').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        );
                        $('#gambar').closest('div').find('.requirement').addClass(
                            'd-none'
                        );  
                        // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                
            });

            $(document).on("click", "#delete_kamar", function(e) {
                e.preventDefault()
                var kamar_id = $(this, 'button').attr('data-id');

                Swal.fire({
                title: 'Yakin ingin menghapus Kamar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete("{{ route('kamar.delete', '') }}" + "/" + kamar_id)

                            .then(function(response) {
                                console.log(response);
                                  $('.kamar-ajax').DataTable().ajax.reload(null, false)

                                Swal.fire(response.data.msg, '', 'success')

                            })
                            .catch(function(error) {
                                // handle error
                                console.log(error);

                                Swal.fire('Terdapat Error di bagian backend', '', 'error')

                            })
                    }
                })

              

            });

            $(document).on("click", "#edit_kamar", function(e) {
                e.preventDefault();
                var kamar_id = $(this, 'button').attr('data-id');
                console.log(kamar_id)
                axios.get("{{ route('kamar.edit', '') }}" + "/" + kamar_id)
                    .then(function(response) {
                        // handle success
                        // console.log(response.data);
                        $('#editModal').modal("show");
                        $('#editBody').html(response.data).show();
                        $('#button_kamar_update').click(function(e) {
                            e.preventDefault();
                            // console.log('fuck')

                            var nama_kamar_edit = $('#nama_kamar_edit').val();
                            var no_kamar_edit = $('#no_kamar_edit').val();
                            var maks_orang_edit = $('#maks_orang_edit').val();
                            var tipe_kamar_edit = $('#tipe_kamar_edit').val();
                            var harga_edit = $('#harga_edit').val();
                            //   var fasilitas = $("[name='fasilitas[]']").val();
                            var fasilitas_edit = $('#fasilitas_edit').val();
                            // var gambar_edit = $('#gambar_edit').val();


                            


                            let formDataEdit = new FormData()
                            formDataEdit.append('nama_kamar', nama_kamar_edit);
                            formDataEdit.append('no_kamar', no_kamar_edit);
                            formDataEdit.append('maks_orang', maks_orang_edit);
                            formDataEdit.append('tipe_kamar', tipe_kamar_edit);
                            formDataEdit.append('harga', harga_edit);
                            formDataEdit.append('fasilitas', fasilitas_edit);
                            formDataEdit.append('gambar', document.getElementById('gambar_edit').files[0]);
                            formDataEdit.append('_method', 'PUT');

                            //   console.log(fasilitas.length,!no_kamar)
                            if (!validasi_nama_kamar() && !validasi_no_kamar() && !validasi_maks_orang() && !validasi_tipe_kamar() && !validasi_fasilitas() && !validasi_harga() ) {
                                var token = document.head.querySelector('meta[name="csrf-token"]');
                                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                                axios.post("{{ route('kamar.update', '') }}" + "/" + kamar_id,formDataEdit, {
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': token.content,
                                            // 'X-Requested-With': 'XMLHttpRequest',
                                        }
                                    })
                                    .then(function(response) {
                                        console.log(response)
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: response.data.msg,
                                        })

                                          $('.kamar-ajax').DataTable().ajax.reload(null, false)
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
                                validasi_nama_kamar();
                                validasi_no_kamar();
                                validasi_maks_orang();
                                validasi_tipe_kamar();
                                validasi_fasilitas();
                                validasi_harga();

                            };

                            function validasi_nama_kamar() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!nama_kamar_edit) {
                                    $('#nama_kamar_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#nama_kamar_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#nama_kamar_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#nama_kamar_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }

                            function validasi_no_kamar() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!no_kamar_edit) {
                                    $('#no_kamar_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#no_kamar_edit').closest('div').find('.invalid-feedback')
                                        .removeClass(
                                            'd-none'
                                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#no_kamar_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#no_kamar_edit').closest('div').find('.invalid-feedback')
                                        .addClass(
                                            'd-none'
                                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }

                            function validasi_maks_orang() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!maks_orang_edit) {
                                    $('#maks_orang_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#maks_orang_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#maks_orang_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#maks_orang_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }

                            function validasi_tipe_kamar() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!tipe_kamar_edit) {
                                    $('#tipe_kamar_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#tipe_kamar_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#tipe_kamar_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#tipe_kamar_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }
                            function validasi_harga() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!harga_edit) {
                                    $('#harga_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#harga_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#harga_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#harga_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }

                            function validasi_fasilitas() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (fasilitas_edit.length == 0) {
                                    $('#fasilitas_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#fasilitas_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
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

            var table = $('.kamar-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('kamar.ajax') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_kamar',
                        name: 'nama_kamar'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
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

        });
    </script>
@endpush
