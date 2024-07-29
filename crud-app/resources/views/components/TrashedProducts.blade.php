@extends('layouts.Admin.adminDash')
@section('admin-dashboard')
<div class="d-flex justify-content-between">
    <h6 class=""><i class="bi bi-journal-richtext"></i> Trashed Products</h6>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">Go
        Back</a>
</div>
<hr class="my-3" />

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
                        <img src="{{ asset('image/' . $product->image) }}" alt="product image"
                            class="img-phone img-fluid" />
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>Rs.{{ $product->mrp }}</td>
                    <td>Rs.{{ $product->price }}</td>
                    <td>
                        <form action="{{ route('admin.products.restore', $product->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                data-bs-placement="left" data-bs-title="Restore"><i
                                    class="bi bi-arrow-clockwise"></i></button>
                        </form>
                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="tooltip"
                            data-bs-placement="right" data-bs-title="Permanently Delete"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
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
