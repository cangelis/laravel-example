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
            \Session::put("user", $this->user);
            return true;
        }
        return false;
    }

    public function updateUser(UserInterface $user) {
        $this->user = $user;
        \Session::put($user);
    }

    /**
     * 
     * @return boolean
     */
    public function isLoggedIn() {
        return \Session::has('user');
    }

    /**
     * 
     * @return UserInterface
     */
    public function getUser() {
        return \Session::get('user');
    }

    public function logout() {
        \Session::forget("user");
    }

}
