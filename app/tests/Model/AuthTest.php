<?php

class AuthTest extends TestCase {

    public function testLoginWithInvalidCredentials() {
        $user = $this->createUser();
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $result = $auth->login("geliscan@gmail.com", "InvalidPassword");
        $this->assertFalse($result);
        $this->assertNull(Session::get('user_id'));
        $user->delete();
    }

    public function testLoginWithValidCredentials() {
        $user = $this->createUser();
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $result = $auth->login("geliscan@gmail.com", "PASSWORD");
        $this->assertTrue($result);
        $this->assertEquals($user->getId(), Session::get('user_id'));
        $user->delete();
    }

    public function testIsLoggedInReturnsTrueWhenSessionIsSet() {
        Session::put('user_id', 1);
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $this->assertTrue($auth->isLoggedIn());
    }

    public function testIsLoggedInReturnsFalseWhenSessionIsNotSet() {
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $this->assertFalse($auth->isLoggedIn());
    }

    public function testGetUserReturnsValidUserInstance() {
        $user = $this->createUser();
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $login = $auth->login($user->getEmail(), "PASSWORD");
        $this->assertTrue($login);
        $this->assertEquals($user, $auth->getUser());
    }

    public function testLogoutForgetsTheSession() {
        Session::put('user_id', 1);
        $auth = new \LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $auth->logout();
        $this->assertFalse($auth->isLoggedIn());
    }

}