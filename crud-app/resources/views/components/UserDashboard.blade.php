@extends('layouts.app') @section('main')
<div class="d-flex justify-content-between">
    <!-- <a href="products/create" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> New Product</a> -->
</div>
<h6 class=""><i class="bi bi-journal-richtext"></i> Product Details</h6>

<hr />
<nav style="
            --bs-breadcrumb-divider: url(
              &#34;data:image/svg + xml,
              %3Csvgxmlns='http://www.w3.org/2000/svg'width='8'height='8'%3E%3Cpathd='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z'fill='%236c757d'/%3E%3C/svg%3E&#34;
            );
          " aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard
        </li>
    </ol>
</nav>
<!-- Search form -->
<form class="d-flex justify-content-end" action="{{ route('search') }}" method="GET">
    <div class="d-flex">
    <input class="form-control w-50" type="text" name="query" placeholder="Search mobile products" required>
    <button class="border border-light-subtle rounded mx-2 p-2" type="submit">Search</button>
    </div>
</form>
<div class="col-md-12 table-responsive mt-5">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">M.R.P</th>
                <th scope="col">Selling Price</th>
                <!-- <th scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody class="align-baseline">
            @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>
                                    <img src="{{ asset('image/' . $product->image) }}" alt="iphone6s" width="100px" height="150px"
                                        class="img-phone img-fluid" />
                                </td>
                                <td><a href="{{ route('account.show', ['id' => $product->id]) }}">{{$product->name}}</a></td>
                                <td>Rs.{{$product->mrp}}</td>
                                <td>Rs.{{$product->price}}</td>
                                <!-- <td>
                                    <a href="products/{{$product->id}}/edit" class="btn btn-sm text-primary fs-6"><i class="bi bi-pencil-square"></i></a>
                                    <button type="button" class="btn btn-sm text-danger fs-6" data-bs-toggle="modal" data-bs-target="#deleteModal{{$product->id}}"><i class="bi bi-trash3"></i></button>
                                </td> -->

                                <!-- Modal -->
                                <!-- <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$product->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{$product->id}}">Confirm Delete</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="products/{{$product->id}}/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
                            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection