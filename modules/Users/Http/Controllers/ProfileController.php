<?php

namespace Modules\Users\Http\Controllers;

use DB;
use Auth;
use SweetAlert;
use Modules\Users\Http\Requests\UpdateUserRequest;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Repositories\UserEntity;
use Hechoenlaravel\JarvisFoundation\Traits\EntryManager;
use Hechoenlaravel\JarvisFoundation\UI\Field\EntityFieldsFormBuilder;

/**
 * Class ProfileController
 * @package Modules\Users\Http\Controllers
 */
class ProfileController extends Controller
{

    use EntryManager;

    /**
     * @var
     */
    protected $user;

    /**
     *
     */
    public function __construct()
    {
        $this->user = Auth::user();
        $this->middleware('auth');
    }

    /**
     * @param UserEntity $entity
     * @return $this
     */
    public function edit(UserEntity $entity)
    {
        $builder = new EntityFieldsFormBuilder($entity->getEntity());
        $builder->setRowId($this->user->id);
        return view('users::me.edit')
            ->with('user', $this->user)
            ->with('profileFields', $builder->render());
    }

    /**
     * @param UpdateUserRequest $request
     * @param UserEntity $entity
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, UserEntity $entity)
    {
        if ($this->user->email !== $request->get('email')) {
            $this->validate($request, [
                'email' => 'unique:app_users,email'
            ]);
        }
        DB::beginTransaction();
        try {
            $this->user->name = $request->get('name');
            $this->user->email = $request->get('email');
            $this->user->save();
            $this->updateEntry($entity->getEntity()->id, $this->user->id, ['input' => $request->all()]);
            DB::commit();
            SweetAlert::success('Se ha editado su perfil', 'Excelente!')->autoclose(3500);
        } catch (EntryValidationException $e) {
            DB::rollBack();
            return back()->withInput($request->all())->withErrors($e->getErrors());
        }
        return redirect()->route('me.edit');
    }

}