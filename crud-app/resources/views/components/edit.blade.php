@extends('layouts.Admin.adminEdit') @section('adminEdit')
<div class="">
<h6 class="p-3"><i class="bi bi-pencil-square text-secondary"></i> Edit Product</h6>
<hr />

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
    </ol>
</nav>

<div class="col-md-6">
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row my-3">
            <div class="col-md-12">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control 
                @if($errors->has('name')) {{'is-invalid'}} @endif
                " id="name" placeholder="Enter Product Name" value="{{old('name', $product->name)}}" />
                @if($errors->has('name'))
                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                @endif
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-6">
                <label for="mrp" class="form-label">M.R.P</label>
                <input type="text" name="mrp" class="form-control
                @if($errors->has('mrp')) {{'is-invalid'}} @endif
                " id="mrp" placeholder="Enter M.R.P" value="{{old('mrp', $product->mrp)}}" />
                @if($errors->has('mrp'))
                <div class="invalid-feedback">{{$errors->first('mrp')}}</div>
                @endif
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Selling Price</label>
                <input type="text" name="price" class="form-control
                @if($errors->has('price')) {{'is-invalid'}} @endif
                " id="price" placeholder="Enter Selling Price" value="{{old('price', $product->price)}}"/>
                @if($errors->has('price'))
                <div class="invalid-feedback">{{$errors->first('price')}}</div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control
                @if($errors->has('description')) {{'is-invalid'}} @endif
                " placeholder="Enter Description" style="resize: none; height: 150px;">{{old('description', $product->description)}}</textarea>
                @if($errors->has('description'))
                <div class="invalid-feedback">{{$errors->first('description')}}</div>
                @endif
            </div>
        </div>

        <div class="row my-3">
            <div class="col-md-12">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" value="{{old('image')}}" class="form-control
                @if($errors->has('image')) {{'is-invalid'}} @endif 
                ">
                @if($errors->has('image'))
                <div class="invalid-feedback">{{$errors->first('image')}}</div>
                @endif
            </div>
        </div>

        <div class="mb-5">
            <button type="submit" class="btn btn-sm btn-success">Update Product</button>
            <button type="reset" class="btn btn-sm btn-danger">Clear All</button>
        </div>

    </form>
</div>
</div>
@endsection