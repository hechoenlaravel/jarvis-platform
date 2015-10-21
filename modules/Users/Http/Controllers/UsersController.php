<?php namespace Modules\Users\Http\Controllers;

use DB;
use SweetAlert;
use Illuminate\Http\Request;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Transformers\UserTransformer;
use Modules\Users\Http\Requests\CreateUserRequest;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\EntryManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\UI\Field\EntityFieldsFormBuilder;
use Joselfonseca\LaravelApiTools\Exceptions\ApiModelNotFoundException;
use Hechoenlaravel\JarvisFoundation\Exceptions\EntryValidationException;

class UsersController extends Controller
{

    use ResponderTrait, EntryManager;

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
        $builder = new EntityFieldsFormBuilder($this->getEntity());
        return view('users::users.create')
            ->with('roles', Role::all()->pluck('name', 'id')->toArray())
            ->with('profileFields', $builder->render());
    }

    public function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = User::create($request->all());
            $user->roles()->sync($request->get('roles'));
            $this->updateEntry($this->getEntity()->id, $user->id, ['input' => $request->all()]);
            DB::commit();
            SweetAlert::success('Se ha creado el Usuario', 'Excelente!')->autoclose(3500);
        }catch (EntryValidationException $e)
        {
            DB::rollBack();
            return back()->withInput($request->all())->withErrors($e->getErrors());
        }
        return redirect()->route('users.index');
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

    protected function getEntity()
    {
        return EntityModel::where('slug', 'users')->where('namespace', 'app')->first();
    }

}