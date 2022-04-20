@extends('guest.layouts.master_step')
@push('style')

@endpush
@section('step_content')
    <div class="row">
        <div class="col-7 ">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label>Nama Pemesan</label>
                            <div class="input-group">
                                <input  type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" value="">

                                <div class="invalid-feedback">
                                    Nama Pemesan tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <input  type="email" class="form-control" name="email" id="email" value="">

                                <div class="invalid-feedback">
                                    Email tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Telpon</label>
                            <div class="input-group">
                                <input  type="text" class="form-control" name="no_telpon" id="no_telpon" value="">

                                <div class="invalid-feedback">
                                    No Telpon tidak boleh kosong!
                                </div>
                            </div>
                        </div>
                      
                        {{-- <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" >
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telpon</label>
                            <input type="text" class="form-control" id="no_telp" >
                        </div> --}}
                        {{-- <div class="mb-3" hidden >
                            <label for="check_in" class="form-label">checkin</label>
                            <input type="date" class="form-control" id="check_in" value="{{$check_in}}" >
                        </div>
                        <div class="mb-3" hidden >
                            <label for="check_out" class="form-label">checkout</label>
                            <input type="date" class="form-control" id="check_out" value="{{$check_out}}" >
                        </div>
                        <div class="mb-3" hidden >
                            <label for="cart_kamar" class="form-label">cart_kamar</label>
                            <input type="text" class="form-control" name="cart_kamar" id="cart_kamar" value="{{$cart_kamar}}" >
                        </div> --}}
                      
                        <a href="{{route('pemesanan_step_two')}}"  class="btn btn-warning">Previous</a>
                        @if ($kamar != null)
                        <button type="submit" id="konfirmasi_pemabayaran" class="btn btn-success" {{ count($kamar) < 1 ? 'disabled' : '' }}>Konfirmasi Pembayaran</button>
                        
                        @else 
                        <button type="submit" id="konfirmasi_pemabayaran" class="btn btn-success" disabled>Konfirmasi Pembayaran</button>

                        @endif
                        </form>
                </div>
            </div>
        </div>
        <div class="col-5 ">
            <div class="card ">
                <img src="https://atpetsi.or.id/uploads/article/view/210507061237200228114324hotel.jpg"  class="w-100 h-50 card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Detail</h5>
                  {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-3">
                                <span>Date</span>
                            </div>
                            <div class="col-8">
                                <span class="text-muted">{{ $check_in }} - {{$check_out }}</span>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <span class="text-muted">{{$jumlah_malam}} Malam</span>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="d-flex justify-content-end mb-1">Jumlah kamar :  {{$kamar != null ? count($kamar) : ''}}</div>
                        
                        @if ($kamar != null)
                         @php
                             $total = 0;
                         @endphp
                            @forelse ($kamar as $item)
                                
                            <div class="row border-bottom mb-1">
                            
                                <div class="col-6">
                                    <span class="text-muted">{{$item->nama_kamar}}</span>
                                </div>
                              
                                <div class="col-6">
                                    <span class="text-muted">{{$item->tipe_kamar->nama_tipe}}</span>
                                </div>
                                <div class="col-6">
                                    <span>Maks Orang</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">{{$item->maks_orang}}</span>
                                </div>
                                <div class="col-6">
                                    <span>Harga</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-muted">{{rupiah($item->harga)}}</span>
                                </div>
                            </div>
                             <input type="hidden"  value="{{$total+=$item->harga}}">

                            
                            @empty
                                
                            @endforelse     
                            @if ($total != null || $total != '')
                            <div class="row border-bottom mb-1">
                                <div class="col-6">
                                    <span>Total Harga </span>
                                </div>
                                <div class="col-6">
                                    <input type="hidden" id="total_harga" value="{{$total}}">
                                    <span class="text-muted" >{{rupiah($total)}}</span>
                                </div>
                            </div>
                            @endif
                            
                        @else

                        @endif

                       
                      

                        
                     
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection

@push('script')
  {{-- //sweet aler --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
     $(document).ready(function () {
        $('#konfirmasi_pemabayaran').click(function(e) {
                e.preventDefault();

                var nama_pemesan =   $('#nama_pemesan').val();
                var email =   $('#email').val();
                var no_telpon =   $('#no_telpon').val();
                var total_harga =   $('#total_harga').val();
              

                //   console.log(fasilitas.length,!disc)
                if (!validasi_nama_pemesan() && !validasi_email() && !validasi_no_telpon()) {
                    var token = document.head.querySelector('meta[name="csrf-token"]');
                    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                    axios.post("{{ route('pemesanan_step_three.store') }}", {
                             nama_pemesan: nama_pemesan,
                             email: email,
                             no_telp: no_telpon,
                             total_harga: total_harga
                        }, {
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token.content,
                                'X-Requested-With': 'XMLHttpRequest',
                            }
                        })
                        .then(function(response) {
                            // console.log(response)
                            axios({
                            url: "{{ route('download.pdf','') }}" + "/" + response.data.data,
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
                                
                                window.location.href = "{{ route('home')}}";
                            });

                         


                        
                        })
                        .catch(function(error) {
                            console.log(error)
                            
                        });

                } else {
                    validasi_nama_pemesan()
                    validasi_email();
                    validasi_no_telpon();
                
                };

                function validasi_nama_pemesan() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!nama_pemesan) {
                        $('#nama_pemesan').addClass('is-invalid'); // Ad class is-invalid
                        $('#nama_pemesan').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#nama_pemesan').removeClass('is-invalid').removeClass('is-invalid');
                        $('#nama_pemesan').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

                function validasi_email() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!email) {
                        $('#email').addClass('is-invalid'); // Ad class is-invalid
                        $('#email').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#email').removeClass('is-invalid').removeClass('is-invalid');
                        $('#email').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }
                function validasi_no_telpon() {
                    // buat ngitung ada berapa yang kena validasi
                    count_erorr = [];
                    if (!no_telpon) {
                        $('#no_telpon').addClass('is-invalid'); // Ad class is-invalid
                        $('#no_telpon').closest('div').find('.invalid-feedback').removeClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu REMOVE class d-none
                        count_erorr += 1
                    } else {
                        $('#no_telpon').removeClass('is-invalid').removeClass('is-invalid');
                        $('#no_telpon').closest('div').find('.invalid-feedback').addClass(
                            'd-none'
                        ); // cari div terdekat dan cari class nya find = cari lalu add class d-none
                    }
                    // return panjang dari collection atau array
                    return count_erorr.length;
                }

              
            });
           
    });
</script>
@endpush