@extends('guest.layouts.master')
@section('content')
    <div class="d-flex justify-content-center">
        <h1>TIPE KAMAR</h1>
    </div>
    {{-- {{dd($tipe)}} --}}
    <div class="row mb-5">
      @foreach ($tipe as $item )
         <div class="col-6">
          <div class="card mb-3 border-radius">
            <img class="card-img-top" style="height: 250px;" src="{{ asset('kamar_image/'. $item->gambar ) }}"
                alt="Card image cap">
            <div class="card-body">
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Tipe {{$item->tipe_kamar->nama_tipe}}</h5>
                </div>
                <div class="col-6">
                  <a href="{{route('detail_kamar',$item->tipe_kamar->id)}}">Detail For Kamar</a>
                </div>
              </div>
                <p class="card-text"><span class="text-muted">{{$item->tipe_kamar->keterangan}}</span></p>
            </div>
        </div>
       
         </div>
      @endforeach

    </div>
    {{-- {{dd($item)}} --}}

@endsection
