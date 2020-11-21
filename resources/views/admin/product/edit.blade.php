<form method="POST" action="{{ route('product.update', $product->id) }}">
    @csrf
    <label>Name: <input type="text" name="name" maxlength="50" placeholder="Product Name" required value="{{ $product->name }}"></label>
    <label>SKU: <input type="text" name="sku" maxlength="20" placeholder="SKU" required  value="{{ $product->sku }}"></label>
    <input type="submit" value="Update Product">
</form>
@if($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif