<?php

namespace LaravelTest\Controller;

use LaravelTest\Model\AuthInterface;
use LaravelTest\Model\Repository\PostInterface;

class Post extends \BaseController {

    private $auth, $post;

    public function __construct(AuthInterface $auth, PostInterface $post) {
	$this->beforeFilter('Auth');
	$this->auth = $auth;
	$this->post = $post;
	\View::share("user", $this->auth->getUser());
    }

    public function getNew() {
	return \View::make("post_new");
    }

    public function postNew() {
	$validator = $this->validateInput();
	if ($validator->fails())
	    return \Redirect::to('post/new')->withErrors($validator);
	$this->post->setContent(\Input::get("content"));
	$this->post->setTitle(\Input::get('title'));
	$this->post->setUser($this->auth->getUser());
	$this->post->save();
	return \Redirect::to('/post/edit/' . $this->post->getId())->with("post_added", true);
    }

    public function getEdit($id) {
	$post = $this->post->init($id);
	if (($post == null) || (!is_numeric($id))) {
	    return \App::abort(404, 'Page not found');
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
	$post = $this->post->init($id);
	if (($post == null) || (!is_numeric($id)))
	    return \App::abort(404);
	$validator = $this->validateInput();
	if ($validator->fails())
	    return \Redirect::to('post/edit/' . $id)->withErrors($validator);
	$this->post->setContent(\Input::get("content"));
	$this->post->setTitle(\Input::get('title'));
	$this->post->save();
	return \View::make('post_edit')->with('post', $this->post)->with('post_edited', true);
    }

    public function getList() {
	$posts = $this->auth->getUser()->getPosts();
	return \View::make('post_list')->with('posts', $posts);
    }

    public function getDelete($id) {
	$this->post->init($id);
	if ($this->post->getUser()->getId() == $this->auth->getUser()->getId()) {
	    $this->post->delete();
	    return \Redirect::to('post/list');
	}
	else
	    return \App::abort(404, 'Page not found');
    }

}