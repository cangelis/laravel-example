<?php

namespace LaravelTest\Controller;

use LaravelTest\Model\AuthInterface;
use LaravelTest\Model\Repository\PostInterface;

class Post extends \BaseController {

    private $auth, $post;

    public function __construct(AuthInterface $auth, PostInterface $post) {
	$this->auth = $auth;
	$this->post = $post;
	\View::share("user", $this->auth->getUser());
    }

    public function getNew() {
	$this->beforeFilter("Auth");
	return \View::make("post_new");
    }

    public function postNew() {
	$this->beforeFilter("Auth");
	$validator = $this->validateInput();
	if ($validator->fails())
	    return \Redirect::back()->withErrors($validator);
	$this->post->setContent(\Input::get("content"));
	$this->post->setTitle(\Input::get('title'));
	$this->post->setUser($this->auth->getUser());
	$this->post->save();
	return \Redirect::to('/post/edit/' . $this->post->getId())->with("post_added", true);
    }

    public function getEdit($id) {
	$this->beforeFilter('Auth');
	$post = $this->post->init($id);
	if ($post == false) {
	    return App::abort(404, 'Page not found');
	}
	return \View::make('post_edit')->with('post', $post);
    }

    /**
     * 
     * @return \Illuminate\Validation\Validator
     */
    private function validateInput() {
	$validator = \Validator::make(\Input::all(), array(
		    'title' => 'required',
		    'content' => 'required'
	));
	return $validator;
    }

    public function postEdit($id) {
	$this->beforeFilter("Auth");
	$this->post->init($id);
	$validator = $this->validateInput();
	if ($validator->fails())
	    return \Redirect::back()->withErrors($validator);
	$this->post->setContent(\Input::get("content"));
	$this->post->setTitle(\Input::get('title'));
	$this->post->save();
	return \View::make('post_edit')->with('post', $this->post)->with('post_edited', true);
    }

    public function getList() {
	$this->beforeFilter("Auth");
	$posts = $this->auth->getUser()->getPosts();
	return \View::make('post_list')->with('posts', $posts);
    }

    public function getDelete($id) {
	$this->beforeFilter("Auth");
	$this->post->init($id);
	if ($this->post->getUser()->getId() == $this->auth->getUser()->getId()) {
	    $this->post->delete();
	    return \Redirect::back();
	}
	else
	    return App::abort(404, 'Page not found');
    }

}