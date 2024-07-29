<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('css/sidebar.css')}}" />
  <script src="{{asset('js/script.js')}}" defer></script>
</head>

<body>
  <!-- As a link -->

  <nav class="navbar sticky-top bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sathisa Mobiles</a>
      <div type="button" class="btn btn-primary position-relative bg-success bg-opacity-75 border-0">
        {{Auth::guard('admin')->user()->name}}
        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
          <span class="visually-hidden">New alerts</span>
        </span>
      </div>

      <a class="navbar-brand btn-t btn btn-sm btn-danger text-white p-0 px-2" href="{{route('account.logout')}}"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
    </div>
  </nav>
  <!-- nav end -->

  <div class="container mt-3">
    <div class="row">
      @if($message=Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show w-50">
        <i class="bi bi-check2-square"></i> {{$message}}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @if($message=Session::get('error'))
      <div class="alert alert-danger alert-dismissible fade show w-50 m-auto ">
      <i class="bi bi-x-circle"></i> {{$message}}
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      @yield('admin-dashboard')
    </div>
    <!-- container end -->
  </div>
@yield('script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="/public/js/script.js"></script> -->
</body>

</html>