<?php namespace Modules\Dashboard\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DashboardController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
	{
		return view('dashboard::index');
	}
	
}