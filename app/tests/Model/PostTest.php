<?php

class PostTest extends TestCase {

    public function testNewPostIsAddedToTheDatabase() {
        $newPost = new LaravelTest\Model\Repository\Post();
        $newUser = $this->createUser();
        $newPost->setContent("newContent");
        $newPost->setTitle("newTitle");
        $newPost->setUser($newUser);
        $newPost->save();
        $checkPost = new LaravelTest\Model\Repository\Post();
        $checkPost = $checkPost->init($newPost->getId());
        $this->assertNotNull($checkPost);
        $this->assertEquals("newContent", $checkPost->getContent());
        $this->assertEquals("newTitle", $checkPost->getTitle());
        $this->assertEquals($newPost->getUser(), $newUser);
    }

    public function testExistingPostIsUpdatedInTheDatabase() {
        $existingPost = $this->createPost();
        $existingPost->setTitle('newTitle');
        $existingPost->setContent('newContent');
        $existingPost->save();
        $newPost = new LaravelTest\Model\Repository\Post();
        $newPost->init($existingPost->getId());
        $this->assertEquals('newTitle', $newPost->getTitle());
        $this->assertEquals('newContent', $newPost->getContent());
    }

    public function testExistingPostIsDeletedFromTheDatabase() {
        $existingPost = $this->createPost();
        $prev_id = $existingPost->getId();
        $existingPost->delete();
        $testPost = new LaravelTest\Model\Repository\Post();
        $this->assertNull($testPost->init($prev_id));
    }

    public function testGetUserReturnsCorrectUser() {
        $post = $this->createPost();
        $checkPost = new LaravelTest\Model\Repository\Post();
        $checkPost->init($post->getId());
        $this->assertEquals($post->getUser(), $checkPost->getUser());
    }

}