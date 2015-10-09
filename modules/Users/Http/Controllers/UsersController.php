<?php namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Users\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Transformers\UserTransformer;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;

class UsersController extends Controller {

    use ResponderTrait;

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

    public function find(Request $request)
    {
        return $this->responseWithPaginator(100, $this->model, new UserTransformer());
    }

}