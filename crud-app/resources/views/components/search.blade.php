<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h1>Search Results</h1>
    <p>You searched for: <strong>{{ $query ?? $search }}</strong></p>

    @if($products->isEmpty())
        <p>No products found.</p>
    @else
        <ul>
            @foreach($products as $product)
                <li>

                    <a href="{{ route('account.show', ['id' => $product->id]) }}">{{ $product->name }}</a>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ $product->price }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
