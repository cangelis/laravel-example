<?php

class LogoutTest extends TestCase {

    public function testLogout() {
	$authMock = \Mockery::mock('\Laravel\Model\AuthInterface');
	$authMock->shouldIgnoreMissing('logout')
		->once();
	\App::instance('Laravel\Model\AuthInterface', $authMock);
	$this->call('GET', 'auth/logout');
	$this->assertRedirectedTo('/');
    }

}