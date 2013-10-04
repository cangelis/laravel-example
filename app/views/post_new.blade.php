@extends('index')
@section('body')
<h1>New Post</h1>
@include('errors')
<div>
    <form action="" method="POST">
        <div>
            <input type="text" name="title" placeholder="Title">
        </div>
        <div>
            <p>Post Content:</p>
            <textarea rows="10" cols="50" name="content"></textarea>
        </div>
        <div>
            <input type="submit" value="Save!">
        </div>
    </form>
</div>
@stop