<?php

namespace LaravelTest\Controller;

use LaravelTest\Model\AuthInterface;

class Auth extends \BaseController {

    /**
     *
     * @var AuthInterface
     */
    private $auth;

    public function __construct(AuthInterface $auth) {
        $this->auth = $auth;
    }

    public function getLogin() {
        return \View::make("login");
    }

    public function postLogin() {
        if ($this->auth->login(\Input::get('email'), \Input::get('password'))) {
            return \Redirect::to("/");
        }
        return \Redirect::back()->with('login', false);
    }

    public function getLogout() {
        $this->auth->logout();
        return \Redirect::to('/');
    }

}
