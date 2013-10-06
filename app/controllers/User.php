<?php
namespace LaravelTest\Controller;

use LaravelTest\Model\Repository\UserInterface;

class User extends \BaseController {

    private $user;

    public function __construct(UserInterface $user) {
	$this->beforeFilter('NoAuthFilter');
	$this->user = $user;
    }

    public function getRegister() {
	return \View::make("register");
    }

    public function postRegister() {
	$validator = \Validator::make(\Input::all(), array(
		    'name' => 'required',
		    'email' => 'required|email|unique:user,email',
		    'password' => 'required|min:6'
			)
	);
	if ($validator->fails()) {
	    return \Redirect::to('/user/register')->withErrors($validator);
	} else {
	    $this->user->setEmail(\Input::get('email'));
	    $this->user->setPassword(\Input::get('password'));
	    $this->user->setName(\Input::get('name'));
	    $this->user->save();
	    return \View::make("success");
	}
    }

}