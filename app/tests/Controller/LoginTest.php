<?php

class LoginTest extends TestCase {

    public function testLoginForm() {
	$response = $this->call('GET', 'auth/login');
	$this->assertResponseOk();
	$this->assertEquals('login', $response->original->getName());
    }

    public function testLoginAttemptWithValidCredentials() {
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$authMock->shouldReceive('login')
		->once()
		->andReturn(true);
	\App::instance('LaravelTest\Model\AuthInterface', $authMock);
	$response = $this->call('POST', 'auth/login');
	$this->assertRedirectedTo('/');
    }

    public function testLoginAttemptWithInvalidCredentials() {
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$authMock->shouldReceive('login')
		->once()
		->andReturn(false);
	\App::instance('LaravelTest\Model\AuthInterface', $authMock);
	$response = $this->call('POST', 'auth/login');
	$this->assertRedirectedTo('auth/login');
	$this->assertTrue(Session::has('login'));
	$this->assertEquals(Session::get('login'), false);
    }

}
