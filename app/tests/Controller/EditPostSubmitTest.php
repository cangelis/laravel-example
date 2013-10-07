<?php

class EditPostSubmitTest extends TestCase {

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testNonExistingPost() {
        $postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
        $postMock->shouldReceive(array(
            'init' => null
        ));
        \App::instance("LaravelTest\Model\Repository\PostInterface", $postMock);
        $response = $this->call('POST', 'post/edit/1');
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
        $this->call('POST', '/post/edit/asd');
        $this->assertResponseStatus(404);
    }

    public function testExistingPostAndInsufficientInput() {
        $postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
        $postMock->shouldReceive('init')
                ->once()
                ->andReturn(\Mockery::self());
        $this->mockFailedValidator();
        \App::instance("LaravelTest\Model\Repository\PostInterface", $postMock);
        $response = $this->call('POST', 'post/edit/1');
        $this->assertRedirectedTo('post/edit/1');
    }

    public function testExistingPostAndSufficientInput() {
        $postMock = \Mockery::mock('\LaravelTest\Model\Repository\PostInterface');
        $postMock->shouldReceive('init')
                ->once()
                ->andReturn(\Mockery::self())
                ->shouldReceive('setContent', 'setTitle', 'save')
                ->shouldReceive(array('getTitle' => 'title', 'getContent' => 'content', 'getId' => 1));
        $this->mockSuccessfulValidator();
        \App::instance("LaravelTest\Model\Repository\PostInterface", $postMock);
        $response = $this->call('POST', 'post/edit/1');
        $this->assertResponseOk();
        $this->assertEquals($response->original->getName(), "post_edit");
        $this->assertViewHas('post_edited', true);
        $this->assertViewHas('post', $postMock);
    }

}
