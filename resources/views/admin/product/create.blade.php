<form method="POST" action="{{ route('product.store') }}">
    @csrf
    <label>Name: <input type="text" name="name" maxlength="50" placeholder="Product Name" required ></label>
    <label>SKU: <input type="text" name="sku" maxlength="20" placeholder="SKU" required  ></label>
    <input type="submit" value="Create Product">
</form>
@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif