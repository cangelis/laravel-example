@extends('index')
@section('body')
<?php
$posts->iterate(function(\LaravelTest\Model\Repository\Post $post) {
            ?>
            <p> {{{ $post->getTitle() }}} | <a href="/post/edit/{{{ $post->getId()}}}">Edit</a> | <a href="/post/delete/{{{ $post->getId()}}}">Delete</a></p>
            <?php
        });
?>
@stop