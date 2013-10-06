<?php

namespace LaravelTest\Model;

use LaravelTest\Model\Repository\UserInterface;

class Auth implements AuthInterface {

    /**
     *
     * @var UserInterface 
     */
    private $user;

    public function __construct(UserInterface $user) {
	$this->user = $user;
    }

    /**
     * 
     * @param mixed $email
     * @param mixed $password
     * @return boolean
     */
    public function login($email, $password) {
	$user = $this->user->initByEmail($email);
	if ($user == false)
	    return false;
	if (\Hash::check($password, $this->user->getPassword())) {
	    \Session::put("user_id", $this->user->getId());
	    return true;
	}
	return false;
    }

    /**
     * 
     * @return boolean
     */
    public function isLoggedIn() {
	return \Session::has('user_id');
    }

    /**
     * 
     * @return UserInterface
     */
    public function getUser() {
	$user = new \LaravelTest\Model\Repository\User();
	$user->init(\Session::get('user_id'));
	return $user;
    }

    public function logout() {
	\Session::forget("user_id");
    }

}
