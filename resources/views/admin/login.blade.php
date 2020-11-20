<html>
    <body>
        <form  method= "POST" action="{{ route('admin.authenticate') }}">
            @csrf
            <input type="email" name="email">
            <input type="password" name="password">
            <input type="submit" value="Login">
        </form>
        @if($errors->all())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
    </body>
</html>