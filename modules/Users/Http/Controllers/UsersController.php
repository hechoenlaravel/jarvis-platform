<?php namespace Modules\Users\Http\Controllers;

use Modules\Users\Entities\User;
use Pingpong\Modules\Routing\Controller;

class UsersController extends Controller {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
	
	public function index()
	{
        $users = $this->model->count();
		return view('users::users.index')->with('users', $users);
	}

    public function create()
    {

    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {

    }

}