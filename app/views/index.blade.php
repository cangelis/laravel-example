@extends('base')
@section('content')
Hello {{{ $user->getName() }}}! | <a href="/post/new">New Post</a> |  <a href="/post/list">My Posts</a> | <a href="/auth/logout">Logout</a>
<div>
@yield('body')
</div>
@stop

