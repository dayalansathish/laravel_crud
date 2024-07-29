@extends('layouts.Admin.adminDash') @section('admin-dashboard')
<div class="">
    <h4 class="">Product Details</h4>
</div>
<nav class="my-3"
          style="
            --bs-breadcrumb-divider: url(
              &#34;data:image/svg + xml,
              %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
            );
          "
          aria-label="breadcrumb"
        >
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">
              View Product
            </li>
          </ol>
        </nav>
<div class="col-md-12 table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Admin Name</th>
            <th scope="col">Created_at</th>
            <th scope="col">Updated_at</th>

        </tr>
    </thead>
    <tbody>
    @if($productsWithAdmin->isNotEmpty())
        @foreach($productsWithAdmin as $product)
        <tr>
            <th class="" scope="row">{{$loop->iteration}}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->admin_name }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>
        </tr>
        @endforeach
        @else
    </tbody>
    @endif
</table>
</div>

@endsection