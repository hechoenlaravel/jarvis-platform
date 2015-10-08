<?php namespace Modules\Users\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UsersController extends Controller {
	
	public function index()
	{
		return view('users::index');
	}
	
}