<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
App::bind('LaravelTest\Model\Repository\UserInterface', 'LaravelTest\Model\Repository\User');
App::bind('LaravelTest\Model\Repository\PostInterface', 'LaravelTest\Model\Repository\Post');
App::bind('LaravelTest\Model\Repository\PostContainerInterface', 'LaravelTest\Model\Repository\PostContainer');
App::bind('LaravelTest\Model\AuthInterface', 'LaravelTest\Model\Auth');

Route::controller("/user", "\LaravelTest\Controller\User");
Route::controller("/auth", "\LaravelTest\Controller\Auth");
Route::controller("/post", "\LaravelTest\Controller\Post");
Route::controller("/", "\LaravelTest\Controller\Index");
