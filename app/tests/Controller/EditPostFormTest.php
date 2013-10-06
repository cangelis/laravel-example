<?php

class EditPostFormTest extends TestCase {

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNonExistingPost() {
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$postMock->shouldReceive('init')
		->once()
		->andReturn(null);
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);
	$this->call('GET', '/post/edit/1');
	$this->assertResponseStatus(404);
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNonIntegerId() {
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$postMock->shouldReceive('init')
		->once()
		->andReturn(null);
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);
	$this->call('GET', '/post/edit/asd');
	$this->assertResponseStatus(404);
    }

    public function testExistingPost() {
	$postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
	$postMock->shouldReceive('init')
		->once()
		->andReturn(\Mockery::self())
		->shouldReceive(array('getId' => 1, 'getTitle' => 'title', 'getContent' => 'content'));
	\App::instance('LaravelTest\Model\Repository\PostInterface', $postMock);
	$response = $this->call('GET', '/post/edit/1');
	$this->assertResponseOk();
	$this->assertViewHas('post', $postMock);
	$this->assertEquals('post_edit', $response->original->getName());
    }

}
