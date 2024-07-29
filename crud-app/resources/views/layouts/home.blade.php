<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('css/sidebar.css')}}" />
  <script src="{{asset('js/script.js')}}" defer></script>
</head>

<body>
  <!-- Navigation bar -->
  <nav class="navbar bg-light">
    <div class="container-fluid">
      <a class="navbar-brand hii" href="#">Sathisa Mobiles</a>
      <div class="d-flex justify-content-center flex-grow-1">
        @if(auth()->check())
          @if(auth()->guard('admin')->check())
            <p class="m-0 me-3 lead fw-normal">Welcome, <span class="text-primary">{{ Auth::guard('admin')->user()->name }}!</span></p>
          @else
            <p class="m-0 me-3">Welcome, {{ Auth::user()->name }}!</p>
          @endif
        @endif
      </div>
      <div class="">
      @if(auth()->check())
          @if(auth()->guard('admin')->check())
          <a class="btn btn-sm btn-success text-white" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
          @else
          <a class="btn btn-sm btn-success text-white" href="{{ route('account.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
          @endif
          <a class="btn btn-sm btn-danger text-white ms-3" href="{{ route('account.logout') }}"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
          @else
          <a class="btn btn-sm btn-primary text-white" href="{{ route('account.login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
          @endif
      </div>
    </div>
  </nav>


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
      @yield('login')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <!-- Include jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>

</html>
