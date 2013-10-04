<?php

namespace LaravelTest\Model\Repository;

interface UserInterface {

    public function init($id);

    public function initByEmail($email);

    public function save();

    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getEmail();

    public function setEmail($email);

    public function getPassword();

    public function setPassword($password);

    public function getPosts();
}

