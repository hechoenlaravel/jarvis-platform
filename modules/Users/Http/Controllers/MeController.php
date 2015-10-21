<?php namespace Modules\Usuarios\Http\Controllers;

use Auth;
use Pingpong\Modules\Routing\Controller;

class MeController extends Controller {
	
	public function edit()
    {
        $user = Auth::user();
        
    }
	
}