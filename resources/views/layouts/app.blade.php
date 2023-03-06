
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/izitoast/css/iziToast.min.css')}}">

 {{-- Data Tables --}}
 <link rel="stylesheet" href="{{ asset('datatable/dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('datatable/responsive.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('datatable/buttons.bootstrap4.min.css') }}">

 {{-- Font Awsome --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" 
 integrity="sha512-QfDd74mlg8afgSqm3Vq2Q65e9b3xMhJB4GZ9OcHDVy1hZ6pqBJPWWnMsKDXM7NINoKqJANNGBuVRIpIJ5dogfA==" 
 crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('layouts.navbar')
      @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">

         @yield('content')

      </div>
      @include('layouts.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
  <script src="{{asset('assets/modules/popper.js')}}"></script>
  <script src="{{asset('assets/modules/tooltip.js')}}"></script>
  <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('assets/modules/moment.min.js')}}"></script>
  <script src="{{asset('assets/js/stisla.js')}}"></script>
  
  {{-- IziToast --}}
 <script src="{{asset('assets/modules/izitoast/js/iziToast.min.js')}}"></script>
  
  <!-- JS Libraies -->

  {{-- DataTables --}}
<script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('datatable/responsive.bootstrap4.min.js') }}"></script>

  <!-- Page Specific JS File -->
  
  {{-- SweetAlert --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>  
  
  <!-- Template JS File -->
  <script src="{{asset('assets/js/scripts.js')}}"></script>
  <script src="{{asset('assets/js/custom.js')}}"></script>

  @stack('script')

  <script>
    @if(session()->has('sukses'))
    iziToast.success({
      title: 'sukses',
      message: '{{session('sukses')}}',
      position: 'topRight'
    });
    @elseif(session()->has('error'))
    iziToast.error({
      title: 'Hello, world!',
      message: '{{session('error')}}',
      position: 'topRight'
    });
    @endif
  </script>
</body>
</html>