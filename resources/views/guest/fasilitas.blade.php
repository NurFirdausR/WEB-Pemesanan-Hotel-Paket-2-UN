@extends('guest.layouts.master')
@push('style')
              {{-- fasilitas     --}}
             <link rel="stylesheet" href="{{asset('fasilitass')}}/css/style.css">
             {{-- /fasilitas --}}

@endpush
@section('content') 

<div class="d-flex justify-content-center">
    <h1>FASILITAS</h1>
</div>
<div class="container"  >
    <div class="row">
        @foreach ($fasilitas as $item)
        <div class="col-md-3 col-sm-6 p-2">
            <div class="box">
                <img src="{{asset('fasilitas_image/'.$item->gambar)}}" style="width: 100%; height: 250px;">
                <div class="box-content">
                    <div class="inner-content">
                        <h3 class="title">{{$item->nama_fasilitas}}</h3>
                        <span class="post">Fasilitas: {{$item->tipe_fasilitas}}</span>
                    </div>
                </div>
            </div>
        </div>
      
        
        
        
        @endforeach
        
    </div>
@endsection
