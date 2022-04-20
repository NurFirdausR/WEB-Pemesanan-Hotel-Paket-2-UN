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
                    <h4>Fasilitas</h4>
                </div>
               
                <div class="card-body">
                        <button class="btn btn-primary m-3" data-toggle="modal" data-target="#add_fasilitas">Tambah
                            Fasilitas</button>
                        <table class="table table-bordered fasilitas-ajax">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Keterangan</th>
                                    <th>Gambar</th>
                                    <th>Tipe Fasilitas</th>
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
    <div class="modal fade" id="add_fasilitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-fasilitas" enctype="multipart/form-data">
                        <div class="card-body">
                            {{-- Baris Pertama --}}
                            <div class="row">
                                {{-- Sebelah Kanan --}}
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Nama Fasilitas</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nama_fasilitas"
                                                id="nama_fasilitas" value="">

                                            <div class="invalid-feedback">
                                                Nama Fasilitas tidak boleh kosong
                                            </div>
                                        </div>
                                    </div>





                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Tipe Fasilitas</label>
                                        <div class="input-group">
                                            <select style="font-size: 15px; font-weight: 600;" name="tipe_fasilitas"
                                                id="tipe_fasilitas" class="form-control col-md-12">
                                                <option style="font-size: 15px; font-weight: 600;" value="" selected>
                                                    --Pilihan--</option>
                                                <option style="font-size: 15px; font-weight: 600;" value="kamar">Kamar
                                                </option>
                                                <option style="font-size: 15px; font-weight: 600;" value="umum">Umum
                                                </option>


                                            </select>
                                            <div class="invalid-feedback">
                                                Tipe Fasilitas tidak boleh koosng
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Keterangan Fasilitas</label>
                                        <div class="input-group">
                                            <textarea class="form-control h-25" name="keterangan" id="keterangan" cols="50" rows="6"></textarea>

                                            <div class="invalid-feedback">
                                                Keterangan tidak boleh kosong
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


                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="button_fasilitas" type="submit"
                        class="btn btn-success btm-md justify-content-end mr-3 text-dark"
                        style="border-radius: 10px; background: rgb(101, 255, 80);">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kamar</h5>

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
        $(document).ready(function() {
            $('#button_fasilitas').click(function(e) {
                e.preventDefault();

                var nama_fasilitas = $('#nama_fasilitas').val();
                var tipe_fasilitas = $('#tipe_fasilitas').val();
                var keterangan = $('#keterangan').val();
                var gambar = $('#gambar').val();
                // var form = $('#form-fasilitas')[0]; // You need to use standard javascript object here
                // var formData = new FormData($('form')[0]);
                // console.log()
                let formData = new FormData()
                formData.append('nama_fasilitas', nama_fasilitas);
                formData.append('tipe_fasilitas', tipe_fasilitas);
                formData.append('keterangan', keterangan);
                formData.append('gambar', document.getElementById('gambar').files[0]);

                // console.log(formData)

                //   console.log(fasilitas.length,!tipe_fasilitas)
                if (!validasi_nama_fasilitas() && !validasi_tipe_fasilitas() && !validasi_keterangan() && !
                    validasi_gambar()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('fasilitas.store') }}", formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                'X-CSRF-TOKEN': token.content,
                                // 'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(function(response) {
                            // console.log(response.data)
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.data.msg,
                            })

                            $('.fasilitas-ajax').DataTable().ajax.reload(null, false)


                            $('#add_fasilitas').modal('hide')
                            nama_fasilitas: $('#nama_fasilitas').val('')
                            tipe_fasilitas: $('#tipe_fasilitas').val('')
                            keterangan: $('#keterangan').val('')
                            gambar: $('#gambar').val('')

                        })
                        .catch(function(error) {
                            console.log(error)
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                // text: error.data.msg,
                            })
                        });

                } else {
                    validasi_nama_fasilitas()
                    validasi_tipe_fasilitas();
                    validasi_keterangan();
                    validasi_gambar();

                };

                function validasi_nama_fasilitas() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama_fasilitas) {
                        $('#nama_fasilitas').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_fasilitas').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_fasilitas').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_fasilitas').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_tipe_fasilitas() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!tipe_fasilitas) {
                        $('#tipe_fasilitas').addClass('is-invalid'); // Ad class is-invalid
                        $('#tipe_fasilitas').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#tipe_fasilitas').removeClass('is-invalid').removeClass('is-invalid');
                        $('#tipe_fasilitas').closest('div').find('.invalid-feedback').addClass(
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

                function validasi_gambar() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!gambar) {
                        $('#gambar').addClass('is-invalid'); // Ad class is-invalid
                        $('#gambar').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else if (gambar.split('.').pop() != 'png' && gambar.split('.').pop() != 'jpg' &&
                        gambar.split('.').pop() != 'jpeg') {
                        $('#gambar').addClass('is-invalid'); // Ad class is-invalid
                        $('#gambar').closest('div').find('.requirement').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
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







            $(document).on("click", "#edit_fasilitas", function(e) {
                e.preventDefault();
                var fasilitas_id = $(this, 'button').attr('data-id');
                console.log(fasilitas_id)
                axios.get("{{ route('fasilitas.edit', '') }}" + "/" + fasilitas_id)
                    .then(function(response) {
                        // handle success
                        // console.log(response.data);
                        $('#editModal').modal("show");
                        $('#editBody').html(response.data).show();
                        $('#button_fasilitas_update').click(function(e) {
                            e.preventDefault();
                            // console.log('fuck')

                            var nama_fasilitas_edit = $('#nama_fasilitas_edit').val();
                            var tipe_fasilitas_edit = $('#tipe_fasilitas_edit').val();
                            var keterangan_edit = $('#keterangan_edit').val();
                            var gambar_edit = $('#gambar_edit').val();


                            let formDataEdit = new FormData()
                            formDataEdit.append('nama_fasilitas', nama_fasilitas_edit);
                            formDataEdit.append('tipe_fasilitas', tipe_fasilitas_edit);
                            formDataEdit.append('keterangan', keterangan_edit);
                            formDataEdit.append('gambar', document.getElementById('gambar_edit')
                                .files[0]);
                            // ajax/axios jika menggunakan formdata harus beri method PUT
                            formDataEdit.append('_method', 'PUT');

                            console.log(formDataEdit)

                            if (!validasi_nama_fasilitas() && !validasi_tipe_fasilitas() && !
                                validasi_keterangan()) {
                                var token = document.head.querySelector(
                                    'meta[name="csrf-token"]');
                                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token
                                    .content;

                                axios.post("{{ route('fasilitas.update', '') }}" + "/" +
                                        fasilitas_id, formDataEdit, {
                                            headers: {
                                                'X-CSRF-TOKEN': token.content
                                            }
                                        })
                                    .then(function(response) {
                                        console.log(response)
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success!',
                                            text: response.data.msg,
                                        })

                                        $('.fasilitas-ajax').DataTable().ajax.reload(null,
                                            false)


                                        $('img').attr('src', '')
                                        // location.reload();
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
                                validasi_nama_fasilitas()
                                validasi_tipe_fasilitas();
                                validasi_keterangan();

                            };

                            function validasi_nama_fasilitas() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!nama_fasilitas) {
                                    $('#nama_fasilitas_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#nama_fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#nama_fasilitas_edit').removeClass('is-invalid')
                                        .removeClass('is-invalid');
                                    $('#nama_fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                                }
                                // return panjang dari collection atau array
                                return count_erorr.length;
                            }

                            function validasi_tipe_fasilitas() {
                                // buat ngitung ada berapa yang kena validasi
                                count_erorr = [];
                                if (!tipe_fasilitas) {
                                    $('#tipe_fasilitas_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#tipe_fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#tipe_fasilitas_edit').removeClass('is-invalid')
                                        .removeClass('is-invalid');
                                    $('#tipe_fasilitas_edit').closest('div').find(
                                        '.invalid-feedback').addClass(
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
                                    $('#keterangan_edit').addClass(
                                    'is-invalid'); // Ad class is-invalid
                                    $('#keterangan_edit').closest('div').find(
                                        '.invalid-feedback').removeClass(
                                        'd-none'
                                    ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                                    count_erorr += 1
                                } else {
                                    $('#keterangan_edit').removeClass('is-invalid').removeClass(
                                        'is-invalid');
                                    $('#keterangan_edit').closest('div').find(
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
            const chooseFile = document.getElementById("gambar");
            const imgPreview = document.getElementById("img-preview");

            chooseFile.addEventListener("change", function() {
                getImgData();
            });

            function getImgData() {
                const files = chooseFile.files[0];
                if (files) {
                    const fileReader = new FileReader();
                    fileReader.readAsDataURL(files);
                    fileReader.addEventListener("load", function() {
                        imgPreview.style.display = "block";
                        imgPreview.innerHTML = '<img src="' + this.result + '" />';
                    });
                }
            }

            var table = $('.fasilitas-ajax').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('fasilitas.ajax') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nama_fasilitas',
                        name: 'nama_fasilitas'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar'
                    },
                    {
                        data: 'tipe_fasilitas',
                        name: 'tipe_fasilitas'
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

        function refreshTable() {
            $('.fasilitas-ajax').each(function() {
                dt = $(this).dataTable();
                dt.fnDraw();
            })
        }
    </script>
@endpush
