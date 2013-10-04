@extends('base')
@section('content')
@if(Session::has('login'))
<p>* Incorrect Login</p>
@endif
<form action="" method="POST">
    <div>
        <input type="text" name="email">
    </div>
    <div>
        <input type="password" name="password">
    </div>
    <div>
        <input type="submit" value="Login Ol! :)">
    </div>
    <div>
        <a href="/user/register">Register</a>
    </div>
</form>
@stop