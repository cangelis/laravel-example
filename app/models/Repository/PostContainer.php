<?php

namespace LaravelTest\Model\Repository;

use Illuminate\Database\Eloquent\Collection;
use LaravelTest\Model\Iterable;
use LaravelTest\Model\Repository\PostContainerInterface;
use LaravelTest\Model\Repository\Post;

class PostContainer implements Iterable, PostContainerInterface {

    private $posts;

    public function __construct(Collection $posts) {
        $this->posts = $posts;
    }

    public function iterate($callback) {
        foreach ($this->posts as $post) {
            $callback(new Post($post));
        }
    }

    public function setDataSource($posts) {
        $this->posts = $posts;
    }

}