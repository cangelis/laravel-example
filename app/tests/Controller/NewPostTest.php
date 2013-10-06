<?php

class NewPostTest extends TestCase {

    public function testNewPostFormWorksUnderHttpGet() {
	$response = $this->call('GET', '/post/new');
	$this->assertResponseOk();
	$this->assertEquals('post_new', $response->original->getName());
    }

    public function testPostIsAddedWithSufficientInput() {
	$this->mockSuccessfulValidator();
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$userMock = \Mockery::mock('\LaravelTest\Model\Repository\UserInterface');
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$userMock->shouldReceive('getId')
		->once()
		->andReturn(1);
	$authMock->shouldReceive('getUser')
		->once()
		->andReturn($userMock);
	$postMock->shouldReceive('save', 'setContent', 'setTitle', 'setUser')
		->with()
		->once()
		->andReturn(true);
	$postMock->shouldReceive('getId')
		->once()
		->andReturn(5);
	\App::instance('LaravelTest\Model\AuthInterface', $authMock);
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);
	$this->call('POST', '/post/new');
	$this->assertRedirectedTo("/post/edit/5");
    }

    public function testNewPostIsNotAddedWithUnsufficientInput() {
	$this->mockFailedValidator();
	$this->call('POST', 'post/new');
	$this->assertRedirectedTo('post/new');
	$this->assertTrue(Session::has('errors'));
    }

}
