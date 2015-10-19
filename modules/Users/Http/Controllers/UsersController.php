<?php namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Transformers\UserTransformer;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\UI\Field\EntityFieldsFormBuilder;
use Joselfonseca\LaravelApiTools\Exceptions\ApiModelNotFoundException;

class UsersController extends Controller
{

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
        $builder = new EntityFieldsFormBuilder(EntityModel::where('slug', 'users')->where('namespace', 'app')->first());
        return view('users::users.create')
            ->with('roles', Role::all()->pluck('name', 'id')->toArray())
            ->with('profileFields', $builder->render());
    }

    public function edit($id)
    {

    }

    public function destroy($id)
    {
        try {
            $user = $this->model->findOrFail($id);
            $user->delete();
            return $this->responseNoContent();
        } catch (ModelNotFoundException $e) {
            throw new ApiModelNotFoundException;
        }
    }

    public function find(Request $request)
    {
        $model = $this->model->with('roles');
        if ($request->has('name')) {
            $model->where('name', 'LIKE', '%' . $request->get('name') . '%');
        }
        if ($request->has('email')) {
            $model->where('email', 'LIKE', '%' . $request->get('email') . '%');
        }
        return $this->responseWithPaginator(100, $model, new UserTransformer());
    }

}