@extends('admin.dashboard')

@section('content')
    <h3>Login</h3>
    <form  method= "POST" action="{{ route('admin.authenticate') }}">
        @csrf
        <input type="email" name="email">
        <input type="password" name="password">
        <input type="submit" value="Login">
    </form> 
@endsection      
 