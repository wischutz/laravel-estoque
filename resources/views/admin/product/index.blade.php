@extends('admin.dashboard')

@section('content')
    <h3>Product List</h3>

    @if(count($products) > 0)
    <table>
        <tr>
            <th>Name</th>
            <th>SKU</th>
            <th>Amount</th>
            <th>Stock level</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
        <td>{{ $product->name }}</td>
        <td>{{ $product->sku }}</td>
        <td>{{ $product->amount }}</td>
        <td>{{ ($product->amount < 100)? 'low' : 'regular' }}</td>
        <td><a href="{{ route('product.edit', $product->id) }}">edit</a> | <a href="{{ route('product.destroy', $product->id) }}">delete</a></td>
        </tr>
        @endforeach
    </table>
    @endif

    <p>{{ count($products) }} registered.</p>
@endsection