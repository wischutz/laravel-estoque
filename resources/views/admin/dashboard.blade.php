<html>
    <head>
        <title>Estoque | Laravel</title>
    </head>
    <body>  
        @if(Auth::check())  
            <header>
                <a href="{{ route('product.create') }}">New product</a> | 
                <a href="{{ route('product.index') }}">Products</a> |
                <a href="{{ route('admin.purchase') }}">Purchase order (adiciona produtos no estoque)</a> |
                <a href="{{ route('admin.sale') }}">Sales order (retira produtos no estoque)</a> |
                <a href="{{ route('product.report') }}">Movements history</a> |
                <a href="{{ route('admin.deauthenticate') }}">Logout</a>                
            </header>
        @endif
        @yield('content')
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </body>
</html>