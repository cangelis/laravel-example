@extends('base')
@section('content')
@include('errors')
<form action="" method="POST">
    <div>
        <input type="text" name="name" placeholder="Name">
    </div>
    <div>
        <input type="text" name="email" placeholder="Email">
    </div>
    <div>
        <input type="password" name="password" placeholder="Password">
    </div>
    <div>
        <input type="submit" value="Register!">
    </div>
</form>
@stop