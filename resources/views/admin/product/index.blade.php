
<a href="{{ route('product.create') }}">New product</a>

<h3>Product List</h3>

@if(count($products) > 0)
<ul>
    @foreach ($products as $product)
       <li><a href=" {{ route('product.edit', $product->id ) }} ">Name: {{ $product->name }} - SKU: {{ $product->sku }}</a> | 
       <a href="{{ route('product.destroy', $product->id) }}">delete</a> </li>
    @endforeach
</ul>
@endif

{{ count($products) }} registered.

@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif