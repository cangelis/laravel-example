<?php

namespace LaravelTest\Model;

use LaravelTest\Model\Repository\UserInterface;

interface AuthInterface {

    public function login($email, $password);

    public function isLoggedIn();

    /**
     * @return UserInterface
     */
    public function getUser();
}
