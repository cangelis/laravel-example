<?php

namespace LaravelTest\Model\Repository;

use LaravelTest\Model\Eloquent\User as EloquentUser;
use LaravelTest\Model\Repository\PostContainerInterface;
use LaravelTest\Model\Repository\PostContainer;

class User implements UserInterface {

    private $user, $id, $name, $email, $password;

    /**
     *
     * @var PostContainer
     */
    private $posts;

    public function __construct(EloquentUser $user, PostContainerInterface $posts) {
        $this->user = $user;
        $this->posts = $posts;
    }

    public function init($id) {
        $user = $this->user->find($id);
        if ($user == null)
            return false;
        $this->user = $user;
        return $this;
    }

    public function initByEmail($email) {
        $user = $this->user->where('email', '=', $email)->first();
        if ($user == null)
            return false;
        $this->user = $user;
        return $this;
    }

    public function save() {
        return $this->user->save();
    }

    public function getId() {
        return $this->user->id;
    }

    public function setId($id) {
        $this->user->id = $id;
    }

    public function getName() {
        return $this->user->name;
    }

    public function setName($name) {
        $this->user->name = $name;
    }

    public function getEmail() {
        return $this->user->email;
    }

    public function setEmail($email) {
        $this->user->email = $email;
    }

    public function setPassword($password) {
        $this->user->password = \Hash::make($password);
    }

    public function getPassword() {
        return $this->user->password;
    }

    public function getPosts() {
        $this->posts->setDataSource($this->user->posts);
        return $this->posts;
    }

}