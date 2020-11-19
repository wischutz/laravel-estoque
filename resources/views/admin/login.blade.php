<html>
    <body>
        <form  method= "POST" action="{{ route('admin.authenticate') }}">
            @csrf
            <input type="email" name="email">
            <input type="password" name="password">
            <input type="submit" value="Login">
        </form>
    </body>
</html>