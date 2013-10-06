<?php

class NoAuthFilterTest extends TestCase {

    public function testWhenUserAuthenticated() {
	$mock = \Mockery::mock('\LaravelTest\Model\AuthInterface')
		->shouldReceive('isLoggedIn')
		->once()
		->andReturn(true)
		->getMock();
	$filter = new \NoAuthFilter($mock);
	$this->assertEquals(302, $filter->filter()->getStatusCode());
	$this->assertContains("/", $filter->filter()->getTargetUrl());
    }

    public function testWhenUserNotAuthenticated() {
	$mock = \Mockery::mock('\LaravelTest\Model\AuthInterface')
		->shouldReceive('isLoggedIn')
		->once()
		->andReturn(false)
		->getMock();
	$filter = new \NoAuthFilter($mock);
	$this->assertTrue(true, $filter->filter());
    }

}
