<?php

namespace LaravelTest\Model\Repository;

interface PostInterface {

    public function init($id);

    public function initWithUser($id);

    public function save();

    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getContent();

    public function setContent($content);

    public function getUser();

    public function setUser(User $user);
}

?>
