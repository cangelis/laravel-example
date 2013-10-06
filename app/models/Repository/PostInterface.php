<?php

namespace LaravelTest\Model\Repository;

interface PostInterface {

    public function __construct();

    public function init($id);

    public function delete();

    public function save();

    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getContent();

    public function setContent($content);

    public function getUser();

    public function setUser(UserInterface $user);
}

?>
