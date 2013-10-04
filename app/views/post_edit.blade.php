@extends('index')
@section('body')
<h1>Edit Post</h1>
@include('errors')
@if (Session::has('post_added'))
<div style="background: yellow">
    Post added successfully
</div>
@endif
@if (isset($post_edited))
<div style="background: yellow">
    Post edited successfully
</div>
@endif
<div>
    <form action="" method="POST">
        <div>
            <input type="text" name="title" value="{{{ $post->getTitle() }}}" placeholder="Title">
        </div>
        <div>
            <p>Post Content:</p>
            <textarea rows="10" cols="50" name="content">{{{ $post->getContent() }}}</textarea>
        </div>
        <div>
            <input type="submit" value="Save!">
        </div>
    </form>
</div>
@stop