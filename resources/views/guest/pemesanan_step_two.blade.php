@extends('guest.layouts.master_step')
@push('style')
@endpush
@section('step_content')
    <div class="card">
        <div class="card-body">
            <h4> Ketersediaan Kamar</h4>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @forelse ($kamar as $item)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="{{ $loop->iteration }}-tab" data-bs-toggle="tab"
                            data-bs-target="#kamar{{ $loop->iteration }}" type="button" role="tab"
                            aria-controls="{{ $loop->iteration }}" aria-selected="false">{{ $item->nama_kamar }}</button>
                    </li>
                @empty
                @endforelse


            </ul>
            <div class="tab-content" id="myTabContent">

                @forelse ($kamar as $item)
                    @php
                        $unbooked_kamar = App\Models\Kamar::where('nama_kamar', $item->nama_kamar)
                            ->where('status', 'unbooked')
                            ->get()
                            ->unique('code_kamar');
                    @endphp
                    <div class="tab-pane fade" id="kamar{{ $loop->iteration }}" role="tabpanel"
                        aria-labelledby="{{ $loop->iteration }}-tab">
                        @forelse ($unbooked_kamar as $item)
                            <div class="card mb-3" >
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset('kamar_image') }}/{{ $item->gambar }}"
                                            class="img-fluid rounded" style="height: 200px; width: 250px;" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark font-bolder">{{ $item->nama_kamar }}</h5>

                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="card-text text-dark">Maks orang : {{ $item->maks_orang }}</p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="card-text text-dark">Tipe Kamar : {{ $item->tipe_kamar->nama_tipe }}
                                                </div>
                                            </div>
                                            <p class="card-text text-dark">Harga : {{ rupiah( $item->harga) }}
                                            </p>
                                            <button class="btn btn-sm btn-success pesan"
                                                data-id="{{ $item->id }}">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card mb-3">
                                <img class="card-img-top" alt="Card image cap">
                                <div class="card-body">

                                </div>
                            </div> --}}
                            {{-- <div class="card bg-dark text-white mb-2">
                            <img class="card-img" src="{{ asset('kamar_image')}}/{{$item->gambar }}" style="height: 400px;"  alt="Card image">
                            <div class="card-img-overlay">
                              <h5 class="card-title text-dark">{{$item->nama_kamar}}</h5>
                              <p class="card-text text-dark">Maks orang : {{$item->maks_orang}}</p>
                              <p class="card-text text-dark">Tipe Kamar : {{$item->tipe_kamar->nama_tipe}}</p>
                                <button class="btn btn-sm btn-secondary pesan" data-id="{{$item->id}}" >Pesan</button>
                            </div>
                          </div> --}}
                        @empty
                        @endforelse
                    </div>
                @empty
                    <div class="d-flex justify-content-center">
                        <h2 class="text-danger">
                            Data Kamar Tidak di temukan!
                        </h2>
                    </div>
                @endforelse
            </div>
            <div class="card">
                <div class="card-body">

                    <a class="btn btn-warning" href="{{ route('pemesanan_step_one') }}">Previous</a>
                    <a class="btn btn-primary" href="{{ route('pemesanan_step_three') }}">Next</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.pesan').click(function(e) {
                e.preventDefault();

                var kamar_id = $(this).attr('data-id')


                console.log(kamar_id)

                var token = document.head.querySelector('meta[name="csrf-token"]');
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;

                axios.post("{{ route('pemesanan_step_two.store') }}", {
                        kamar_id: kamar_id,


                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token.content,
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        location.reload();

                    })
                    .catch(function(error) {
                        console.log(error)

                    });

            });



        });
    </script>
@endpush
