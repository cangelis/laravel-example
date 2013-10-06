<?php

class ListPostTest extends TestCase {

    public function testListPost() {
	$postContainerMock = \Mockery::mock('\LaravelTest\Model\Repository\PostContainerInterface');
	$postContainerMock->shouldReceive('iterate')
		->once();
	$userMock = \Mockery::mock('\LaravelTest\Model\Repository\UserInterface');
	$userMock->shouldReceive(array('getName' => 'test', 'getId' => 'test', 'getPassword' => 'test', 'getPosts' => $postContainerMock));
	$authMock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$authMock->shouldReceive('getUser')
		->once()
		->andReturn($userMock);
	\App::instance("LaravelTest\Model\AuthInterface", $authMock);
	$this->call('GET', '/post/list');
	$this->assertResponseOk();
	$this->assertViewHas('posts', $postContainerMock);
    }

}
