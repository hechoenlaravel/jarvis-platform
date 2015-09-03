<?php namespace Modules\Profile\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ProfileController extends Controller {
	
	public function index()
	{
		return view('profile::index');
	}
	
}