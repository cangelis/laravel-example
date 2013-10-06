<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    /**
     * Creates the application.
     *
     * @return Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
	$unitTesting = true;

	$testEnvironment = 'testing';

	return require __DIR__ . '/../../bootstrap/start.php';
    }

    public function mockSuccessfulValidator() {
	Validator::shouldReceive('make')
		->once()
		->andReturn(Mockery::mock(array('fails' => false)));
    }

    public function mockFailedValidator() {
	Validator::shouldReceive('make')
		->once()
		->andReturn(Mockery::mock(array('fails' => true)));
    }

}
