

  @extends('guest.layouts.master')
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .nav-pills-custom .nav-link {
    color: #aaa;
    background: #fff;
    position: relative;
}

.nav-pills-custom .nav-link.active {
    color: #45b649;
    background: #fff;
}


/* Add indicator arrow for the active tab */
@media (min-width: 992px) {
    .nav-pills-custom .nav-link::before {
        content: '';
        display: block;
        border-top: 8px solid transparent;
        border-left: 10px solid #fff;
        border-bottom: 8px solid transparent;
        position: absolute;
        top: 50%;
        right: -10px;
        transform: translateY(-50%);
        opacity: 0;
    }
}

.nav-pills-custom .nav-link.active::before {
    opacity: 1;
}


</style>
@endpush
@section('content')
<!-- Demo header-->
<section class="py-5 header">
    <div class="container py-4">


        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow {{request()->routeIs('pemesanan_step_one') ? 'active' : ''}} "  data-toggle="pill" href="{{route('pemesanan_step_one')}}" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        {{-- <span class="font-weight-bold small text-uppercase">{{session()->get('range') != null ? session()->get('check_in') - session()->get('check_out') : 'Cek Ketersediaan'}}</span> --}}
                        <span class="font-weight-bold small text-uppercase">Cek Ketersediaan</span>
                    </a>
                    <a class="nav-link mb-3 p-3 shadow {{request()->routeIs('pemesanan_step_two') ? 'active' : ''}} "  data-toggle="pill" href="{{route('pemesanan_step_two')}}" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Bookings</span>
                    </a>
                    <a class="nav-link mb-3 p-3 shadow {{request()->routeIs('pemesanan_step_three') ? 'active' : ''}} "  data-toggle="pill" href="{{route('pemesanan_step_three')}}" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Informasi Diri</span>
                    </a>

                </div>
            </div>


            <div class="col-md-9">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    @yield('step_content')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')

    
@endpush