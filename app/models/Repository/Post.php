<?php

namespace LaravelTest\Model\Repository;

use LaravelTest\Model\Eloquent\Post as EloquentPost;
use LaravelTest\Model\Repository\User;

class Post implements PostInterface {

    private $post, $id, $title, $content;

    /**
     *
     * @var User
     */
    private $user;

    public function __construct(EloquentPost $post) {
        $this->post = $post;
    }

    public function init($id) {
        $post = $this->post->find($id);
        if ($post == null)
            return false;
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

    public function getUser() {
        return $this->user;
    }

    public function setUser(UserInterface $user) {
        $this->user = $user;
    }

}
