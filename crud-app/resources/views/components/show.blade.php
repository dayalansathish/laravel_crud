@extends('layouts.app')
@section('main')
<h6 class="p-3"><i class="bi bi-eye-fill"></i> Product Details</h6>
        <hr />
        <nav
          style="
            --bs-breadcrumb-divider: url(
              &#34;data:image/svg + xml,
              %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
            );
          "
          aria-label="breadcrumb"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('account.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              View Product
            </li>
          </ol>
        </nav>

        <div class="card mt-3">
          <img
            src="/image/{{$product->image}}"
            alt="{{$product->name}}"
            class="card-img-top rounded-5 img-fluid"
          />

          <div class="card-body">
            <h6 class="card-title fw-semibold">{{$product->name}}</h6>
            <p class="card-text text-secondary">
            {{$product->description}}
            </p>
            <p class="fw-semibold">M.R.P <small class="text-danger text-decoration-line-through px-2">Rs.{{$product->mrp}}</small></p>
            <p class="fw-semibold">Selling Price <small class="text-success px-2">Rs.{{$product->price}}</small></p>
          </div>
        </div>

@endsection