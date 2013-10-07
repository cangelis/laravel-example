<?php

namespace LaravelTest\Model\Repository;

use Illuminate\Database\Eloquent\Collection;
use LaravelTest\Model\Repository\Post;
use LaravelTest\Model\Repository\PostContainerInterface;

class PostContainer implements PostContainerInterface {

    private $posts;

    public function iterate($callback) {
	foreach ($this->posts as $post) {
	    $p = new Post();
	    $p->setDataSource($post);
	    $callback($p);
	}
    }

    public function setDataSource(Collection $posts) {
	$this->posts = $posts;
    }

}