<?php

namespace LaravelTest\Controller;

use LaravelTest\Model\AuthInterface;

class Index extends \BaseController {

    private $auth;

    public function __construct(AuthInterface $auth) {
        $this->beforeFilter('Auth');
        $this->auth = $auth;
    }

    public function getIndex() {
        return \View::make("index", array(
                    'user' => $this->auth->getUser()
        ));
    }

}
