<?php

class RegisterTest extends TestCase {

    public function testRegisterGetMethodWorks() {
	$response = $this->call('GET', '/user/register');
	$this->assertResponseOk();
	$this->assertEquals("register", $response->original->getName());
    }

    public function mockUserInterface() {
	return \Mockery::mock('LaravelTest\Model\Repository\UserInterface')
			->shouldReceive('save', 'setEmail', 'setPassword', 'setName')
			->once()
			->andReturn(true)
			->getMock();
    }

    public function testRegisterPostMethodWorksWithProperInput() {
	$this->mockSuccessfulValidator();
	$userMock = $this->mockUserInterface();
	\App::instance('LaravelTest\Model\Repository\UserInterface', $userMock);
	$response = $this->call('POST', '/user/register');
	$this->assertResponseOk();
	$this->assertEquals("success", $response->original->getName());
    }

    public function testRegisterPostMethodDoesNotWorkWithInsufficientInput() {
	$this->mockFailedValidator();
	$userMock = $this->mockUserInterface();
	\App::instance('LaravelTest\Model\Repository\UserInterface', $userMock);
	$this->call('POST', '/user/register');
	$this->assertRedirectedTo('/user/register');
	$this->assertTrue(Session::has('errors'));
    }

}