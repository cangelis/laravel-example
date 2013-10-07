<?php

class UserTest extends TestCase {

    public function testInitReturnsNullWhenThereIsNoRowInDatabase() {
        $user = new LaravelTest\Model\Repository\User();
        $result = $user->init(1);
        $this->assertNull($result);
    }

    public function testInitReturnsTrueInstance() {
        $user = $this->createUser();
        $userUnderTest = new LaravelTest\Model\Repository\User();
        $userUnderTest->init($user->getId());
        $this->assertEquals($user->getId(), $userUnderTest->getId());
        $this->assertEquals($user->getName(), $userUnderTest->getName());
        $this->assertEquals($user->getEmail(), $userUnderTest->getEmail());
        $this->assertEquals($user->getPassword(), $userUnderTest->getPassword());
    }

    public function testInitByEmailReturnsNullWhenThereIsNot() {
        $user = new LaravelTest\Model\Repository\User();
        $result = $user->initByEmail("test@test.com");
        $this->assertNull($result);
    }

    public function testInitByEmailReturnsTrueInstance() {
        $user = $this->createUser();
        $userUnderTest = new LaravelTest\Model\Repository\User();
        $userUnderTest->initByEmail($user->getEmail());
        $this->assertEquals($user->getId(), $userUnderTest->getId());
        $this->assertEquals($user->getName(), $userUnderTest->getName());
        $this->assertEquals($user->getEmail(), $userUnderTest->getEmail());
        $this->assertEquals($user->getPassword(), $userUnderTest->getPassword());
    }

    public function testNewUserIsAddedToTheDatabase() {
        $user = new LaravelTest\Model\Repository\User();
        $user->setEmail("test@test.com");
        $user->setName("Can");
        $user->setPassword("1234");
        $user->save();
        $tmpUser = new LaravelTest\Model\Repository\User();
        $tmpUser->init($user->getId());
        $this->assertEquals("test@test.com", $tmpUser->getEmail());
        $this->assertEquals("Can", $tmpUser->getName());
        $auth = new LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $this->assertTrue($auth->login($tmpUser->getEmail(), "1234"));
    }

    public function testUserUpdateInTheDatabase() {
        $user = $this->createUser();
        $user->setEmail('test@test.com');
        $user->setName('newName');
        $user->setPassword('newPassword');
        $user->save();
        $tmpUser = new LaravelTest\Model\Repository\User();
        $tmpUser->init($user->getId());
        $this->assertEquals("test@test.com", $tmpUser->getEmail());
        $this->assertEquals("newName", $tmpUser->getName());
        $auth = new LaravelTest\Model\Auth(new LaravelTest\Model\Repository\User());
        $this->assertTrue($auth->login($tmpUser->getEmail(), "newPassword"));
    }

    public function testGetPostsReturnsCorrectResults() {
        $user = $this->createUser();
        $post_include_list = array();
        $post_exclude_list = array();
        array_push($post_include_list, $this->createPost($user));
        array_push($post_include_list, $this->createPost($user));
        array_push($post_include_list, $this->createPost($user));
        array_push($post_include_list, $this->createPost($user));
        array_push($post_exclude_list, $this->createPost());
        array_push($post_exclude_list, $this->createPost());
        array_push($post_exclude_list, $this->createPost());
        $i = 0;
        $user->getPosts()->iterate(function($post) use (&$i) {
                    $i = $i +1;
                });
        $this->assertEquals(count($post_include_list), $i);
    }

}
