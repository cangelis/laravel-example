<?php

namespace LaravelTest\Model\Eloquent;

class Post extends \Eloquent {

    public $table = 'post';

    public function user() {
	return $this->belongsTo('LaravelTest\Model\Eloquent\User');
    }

}
