<?php

namespace LaravelTest\Model\Repository;

use LaravelTest\Model\Repository\User;

class Post implements PostInterface {

    private $post;

    /**
     *
     * @var User
     */
    private $user;

    public function __construct() {
	$this->post = new \LaravelTest\Model\Eloquent\Post();
    }

    public function setDataSource(\LaravelTest\Model\Eloquent\Post $post) {
	$this->post = $post;
    }

    public function init($id) {
	$post = $this->post->find($id);
	if ($post == null)
	    return null;
	$this->post = $post;
	return $this;
    }

    public function save() {
	if (!is_null($this->user))
	    $this->post->user_id = $this->user->getId();
	$this->post->save();
    }

    public function getId() {
	return $this->post->id;
    }

    public function setId($id) {
	$this->post->id = $id;
    }

    public function getTitle() {
	return $this->post->title;
    }

    public function setTitle($title) {
	$this->post->title = $title;
    }

    public function getContent() {
	return $this->post->content;
    }

    public function setContent($content) {
	$this->post->content = $content;
    }

    /**
     * 
     * @return User
     */
    public function getUser() {
	if (is_null($this->user)) {
	    $this->user = new User();
	    $this->user->setDataSource($this->post->user);
	}
	return $this->user;
    }

    public function delete() {
	return $this->post->delete();
    }

    public function setUser(UserInterface $user) {
	$this->user = $user;
    }

}
