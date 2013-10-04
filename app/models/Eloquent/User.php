<?php

namespace LaravelTest\Model\Eloquent;

class User extends \Eloquent {

    public $table = 'user';

    public function posts() {
        return $this->hasMany('LaravelTest\Model\Eloquent\Post');
    }
    
}

?>