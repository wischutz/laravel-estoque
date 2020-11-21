<h3>Purchase order</h3>
@if(count($products) > 0)
    <form method="POST" action="{{ route('admin.purchase.store') }}">
        @csrf
        <label> 
            Product
            <select name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </label>
        <label>
            Amount
            <input type="text" name="amount" required> 
        </label>
        <input type="submit" value="Submit">
    </form>
@else
    You dont have any product on this database. Try to <a href="{{ route('product.create') }}">add a new product</a> first.
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif
