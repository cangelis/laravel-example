<?php

class AuthFilterTest extends TestCase {

    public function testWhenUserAuthenticated() {
	$mock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$mock->shouldReceive('isLoggedIn')
		->once()
		->andReturn(true);
	$filter = new \AuthFilter($mock);
	$this->assertTrue(true, $filter->filter());
    }

    public function testWhenUserNotAuthenticated() {
	$mock = \Mockery::mock('\LaravelTest\Model\AuthInterface');
	$mock->shouldReceive('isLoggedIn')
		->once()
		->andReturn(false);
	$filter = new \AuthFilter($mock);
	$this->assertEquals(302, $filter->filter()->getStatusCode());
	$this->assertContains("auth/login", $filter->filter()->getTargetUrl());
    }

}
