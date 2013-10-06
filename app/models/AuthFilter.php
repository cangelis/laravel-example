<?php

use LaravelTest\Model\AuthInterface;

class AuthFilter {

    private $auth;

    public function __construct(AuthInterface $auth) {
	$this->auth = $auth;
    }

    public function filter() {
	if (!$this->auth->isLoggedIn()) {
	    return Redirect::to("/auth/login");
	}
    }

}
