<?php

class DeletePostTest extends TestCase {

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNonAuthorizedPostDeleteAttempt() {
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$authMock->shouldReceive('getUser->getId')
		->once()
		->andReturn(1);
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$postMock->shouldReceive('init')
		->once()
		->andReturn(\Mockery::self());
	$postMock->shouldReceive('getUser->getId')
		->once()
		->andReturn(2);
	$postMock->shouldIgnoreMissing('delete');
	\App::instance('LaravelTest\Model\AuthInterface', $authMock);
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);

	$response = $this->call('GET', '/post/delete/1');
	$this->assertResponseStatus(404);
    }

    public function testAuthorizedPostDelete() {
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$authMock->shouldReceive('getUser->getId')
		->once()
		->andReturn(1);
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$postMock->shouldReceive('init')
		->once()
		->andReturn(\Mockery::self());
	$postMock->shouldReceive('getUser->getId')
		->once()
		->andReturn(1);
	$postMock->shouldIgnoreMissing('delete');
	\App::instance('LaravelTest\Model\AuthInterface', $authMock);
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);

	$response = $this->call('GET', '/post/delete/1');
	$this->assertRedirectedTo('post/list');
    }

}