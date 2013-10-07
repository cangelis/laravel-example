<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    public function setUp() {
        parent::setUp();
        Artisan::call('migrate');
    }

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

    public function createUser() {
        $user = new LaravelTest\Model\Repository\User();
        $user->setEmail("geliscan@gmail.com");
        $user->setName("Can Geliş");
        $user->setPassword("PASSWORD");
        $user->save();
        return $user;
    }

    public function createPost(\LaravelTest\Model\Repository\UserInterface $user = null) {
        $post = new LaravelTest\Model\Repository\Post();
        $post->setContent("testContent");
        $post->setTitle("testTitle");
        if ($user == null)
            $user = $this->createUser();
        $post->setUser($user);
        $post->save();
        return $post;
    }

}
