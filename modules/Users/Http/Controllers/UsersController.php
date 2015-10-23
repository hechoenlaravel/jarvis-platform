<?php namespace Modules\Users\Http\Controllers;

use DB;
use Auth;
use Module;
use SweetAlert;
use Illuminate\Http\Request;
use Modules\Users\Entities\Role;
use Modules\Users\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Repositories\UserEntity;
use Joselfonseca\ImageManager\ImageManager;
use Modules\Users\Transformers\UserTransformer;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Modules\Users\Http\Requests\CreateUserRequest;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\EntryManager;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\UI\Field\EntityFieldsFormBuilder;
use Joselfonseca\LaravelApiTools\Exceptions\ApiModelNotFoundException;
use Hechoenlaravel\JarvisFoundation\Exceptions\EntryValidationException;

/**
 * Class UsersController
 * @package Modules\Users\Http\Controllers
 */
class UsersController extends Controller
{

    use ResponderTrait, EntryManager;

    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->middleware('auth');
        $this->model = $model;
    }

    /**
     * list view for users
     * @return $this
     */
    public function index()
    {
        $users = $this->model->count();

        return view('users::users.index')->with('users', $users);
    }

    /**
     * Create form for User
     * @return $this
     */
    public function create(UserEntity $entity)
    {
        $builder = new EntityFieldsFormBuilder($entity->getEntity());

        return view('users::users.create')
            ->with('roles', Role::all()->pluck('name', 'id')->toArray())
            ->with('profileFields', $builder->render());
    }

    /**
     *
     * @param CreateUserRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CreateUserRequest $request, UserEntity $entity)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->all());
            $user->roles()->sync($request->get('roles'));
            $this->updateEntry($entity->getEntity()->id, $user->id, ['input' => $request->all()]);
            DB::commit();
            SweetAlert::success('Se ha creado el Usuario', 'Excelente!')->autoclose(3500);
        } catch (EntryValidationException $e) {
            DB::rollBack();

            return back()->withInput($request->all())->withErrors($e->getErrors());
        }

        return redirect()->route('users.index');
    }

    /**
     * Edit a user
     * @param $uuid
     * @return $this
     */
    public function edit(UserEntity $entity, $uuid)
    {
        $user = User::byUuid($uuid)->firstOrFail();
        $builder = new EntityFieldsFormBuilder($entity->getEntity());
        $builder->setRowId($user->id);

        return view('users::users.edit')
            ->with('user', $user)
            ->with('roles', Role::all()->pluck('display_name', 'id')->toArray())
            ->with('profileFields', $builder->render());
    }

    /**
     * Update a user
     * @param UpdateUserRequest $request
     * @param $uuid
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, UserEntity $entity, $uuid)
    {
        $user = User::byUuid($uuid)->firstOrFail();
        if ($user->email !== $request->get('email')) {
            $this->validate($request, [
                'email' => 'unique:app_users,email'
            ]);
        }
        DB::beginTransaction();
        try {
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            if($request->has('active'))
            {
                $user->active = $request->get('active');
            }
            $user->save();
            $this->updateEntry($entity->getEntity()->id, $user->id, ['input' => $request->all()]);
            DB::commit();
            SweetAlert::success('Se ha editado el Usuario', 'Excelente!')->autoclose(3500);
        } catch (EntryValidationException $e) {
            DB::rollBack();
            return back()->withInput($request->all())->withErrors($e->getErrors());
        }

        return redirect()->route('users.index');
    }

    /**
     * Delete a user
     * @param $id
     * @return mixed
     */
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

    /**
     * Find Users
     * @param Request $request
     * @return mixed
     */
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

    /**
     * Update the user's avatar
     * @param ImageManager $manager
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAvatar(ImageManager $manager, $id)
    {
        $file = $manager->doUpload(0);
        $user = User::find($id);
        $user->avatar = $file->id;
        $user->save();
        return $this->simpleArray($file->toArray());
    }

}