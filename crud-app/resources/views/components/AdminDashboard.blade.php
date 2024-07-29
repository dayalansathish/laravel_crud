<!-- // resources/views/components/AdminDashboard.blade.php -->
@extends('layouts.Admin.adminDash')
@section('admin-dashboard')
<div class="d-flex justify-content-between">
    <h6 class=""><i class="bi bi-journal-richtext"></i> Product Details</h6>
    <div class="">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> New
            Product</a>
        <a href="{{ route('admin.products.details') }}" class="btn btn-success btn-sm"><i
                class="bi bi-journal-check"></i> Product Details</a>
        <a href="{{ route('admin.products.trashed') }}" class="btn btn-danger btn-sm"><i
                class="bi bi-journal-richtext"></i> Trashed
            Product</a>
    </div>
</div>
<hr class="my-3" />
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home-page') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard/Status Code: {{ $statusCode }}</li>
    </ol>
</nav>
<div class="col-md-12 table-responsive mt-5">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">M.R.P</th>
                <th scope="col">Selling Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="align-baseline">
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $loop->index + ($products->currentPage() - 1) * $products->perPage() + 1 }}</th>
                    <td>
                        <img src="{{ asset('image/' . $product->image) }}" alt="iphone6s" class="img-phone img-fluid" />
                    </td>
                    <td><a href="products/{{$product->id}}/show">{{ $product->name }}</a></td>
                    <td>Rs.{{ $product->mrp }}</td>
                    <td>Rs.{{ $product->price }}</td>
                    <td>
                        <a href="products/{{$product->id}}/edit" class="btn btn-sm text-primary fs-6"  data-bs-toggle="tooltip"
                        data-bs-placement="left" data-bs-title="edit"><i
                                class="bi bi-pencil-square"></i></a>
                                <button type="button" class="btn btn-sm text-danger fs-6" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{$product->id}}"><i class="bi bi-trash3"></i></button>
                        <!-- @if($product->trashed())
                            <form action="{{ route('admin.products.restore', $product->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm text-success fs-6"><i
                                        class="bi bi-arrow-clockwise"></i></button>
                            </form>
                        @else
                            <button type="button" class="btn btn-sm text-danger fs-6" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{$product->id}}"  data-bs-toggle="tooltip"
                                data-bs-placement="top" data-bs-title="delete"><i class="bi bi-trash3"></i></button>
                        @endif -->
                    </td>
                    <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{$product->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{$product->id}}">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-md-12 d-flex justify-content-end">
        {{ $products->links() }}
    </div>
</div>
@endsection

@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
</script>
@endsection