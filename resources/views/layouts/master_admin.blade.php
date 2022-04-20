
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; Stisla</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- CSS Libraries -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />




{{-- font --}}
<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
{{-- font --}}

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
  <link rel="stylesheet" href="{{asset('assets')}}/css/components.css">
  @stack('style')

  <style>
    .hotel-font {
      font-family: 'Kaushan Script', cursive;
    }
  </style>
</head>

<body>
    <div class="main-wrapper">
      <div class="navbar-bg " style="height: 80px;"></div>
      <nav class="navbar navbar-expand-lg main-navbar" >
        <form class="form-inline mr-auto">
 
            <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            </ul>
        
         
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('assets')}}/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{Auth::user()->name}}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{ url()->route('logout') }}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
     <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('dashboard')}}" class="hotel-font">Hotel Transylvania</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html" class="hotel-font">HT</a>
          </div>
          <ul class="sidebar-menu">
            {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>DASHBOARD</span></a></li> --}}
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="{{route('admin.dashboard.index')}}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                  <i class=" fas fa-rocket"></i> DASHBOARD
                </a>
        
              </div>
              <li class="menu-header">Master Data</li>
              {{-- <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Kamar</span></a>
                <ul class="dropdown-menu">
                  <li class="active"><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                  <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
                </ul>
              </li> --}}
              
              <li  class="{{request()->routeIs('kamar.index') ? 'active' : ''}}"><a class="nav-link " href="{{route('kamar.index')}}"><i class="fa-solid fa-door-closed"></i><span>Kamar</span></a></li>
              <li  class="{{request()->routeIs('tipe_kamar.index') ? 'active' : ''}}"><a class="nav-link " href="{{route('tipe_kamar.index')}}"><i class="fa-solid fa-wand-magic-sparkles"></i> <span>Tipe Kamar</span></a></li>
              <li  class="{{request()->routeIs('fasilitas.index') ? 'active' : ''}}"><a class="nav-link " href="{{route('fasilitas.index')}}"><i class="fa-solid fa-hot-tub-person"></i><span>Fasilitas</span></a></li>
              <li  class="{{request()->routeIs('reservasi.index') ? 'active' : ''}}"><a class="nav-link " href="{{route('reservasi.index')}}"><i class="fa-solid fa-clipboard"></i><span>Reservasi</span></a></li>
              <li  class="{{request()->routeIs('referral.index') ? 'active' : ''}}"><a class="nav-link " href="{{route('referral.index')}}"><i class="fa-solid fa-code-fork"></i><span> Discount Code</span></a></li>
             
             
            </ul>

           
        </aside>
      </div>

      <!-- Main Content -->
      @yield('content')
    
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
  </div>



  {{-- axios --}}
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  {{-- axios --}}

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

  {{-- //sweet aler --}}
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- //sweet aler --}}

  {{-- <script src="{{asset('assets')}}/js/stisla.js"></script> --}}
  @stack('scripts')
       {{-- <script>
     
       </script> --}}


  <!-- Template JS File -->
  <script src="{{asset('assets')}}/js/scripts.js"></script>

  <!-- Page Specific JS File -->
  {{-- <script src="{{asset('assets')}}/js/page/index-0.js"></script> --}}
</body>
</html>
