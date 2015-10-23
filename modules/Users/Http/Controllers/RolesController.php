<?php

namespace Modules\Users\Http\Controllers;

use Auth;
Use Module;
use Datatables;
use SweetAlert;
use Illuminate\Http\Request;
use Modules\Users\Entities\Role;
use yajra\Datatables\Html\Builder;
use Modules\Users\Entities\Permission;
use Pingpong\Modules\Routing\Controller;
use Modules\Users\Http\Requests\CreateRoleRequest;

/**
 * Class RolesController
 * @package Modules\Users\Http\Controllers
 */
class RolesController extends Controller
{

    /**
     * Datatables Html Builder
     * @var Builder
     */
    protected $htmlBuilder;

    /**
     * @param Builder $htmlBuilder
     */
    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Role::select(['id', 'name', 'display_name', 'description']))
                ->addColumn('actions', function ($role) {
                    return $this->getButtons($role);
                })
                ->make(true);
        }
        $html = $this->htmlBuilder
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'Id'])
            ->addColumn(['data' => 'display_name', 'name' => 'display_name', 'title' => 'Nombre'])
            ->addColumn(['data' => 'description', 'name' => 'description', 'title' => 'Descripción'])
            ->addColumn(['data' => 'actions', 'name' => 'actions', 'title' => '']);
        return view('users::roles.index')->with('html', $html);
    }

    /**
     * @return \BladeView|bool|\Illuminate\View\View
     */
    public function create()
    {
        return view('users::roles.create');
    }

    /**
     * @param CreateRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create($request->all());
        SweetAlert::success('Se ha creado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

    /**
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('users::roles.edit')->with('role', $role);
    }

    /**
     * @param CreateRoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->all());
        $role->save();
        SweetAlert::success('Se ha actualizado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        SweetAlert::success('Se ha eliminado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

    /**
     * @param $role
     * @return string
     */
    public function getButtons($role)
    {
        $buttons = "";
        if($role->name != 'administrador-del-sistema'){
            if(Auth::user()->can('edit-role'))
            {
                $buttons .= '<a href="'.route('roles.edit', ['id' => $role->id]).'" data-toggle="tooltip" data-placement="top" title="Editar rol" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i></a>&nbsp;';
            }
            if(Auth::user()->can('delete-role'))
            {
                $buttons .= '<a href="'.route('roles.destroy', ['id' => $role->id]).'" data-toggle="tooltip" data-placement="top" title="Eliminar rol" class="btn btn-sm btn-danger confirm-delete"><i class="fa fa-times"></i></a>&nbsp;';
            }
            if(Auth::user()->can('admin-permissions'))
            {
                $buttons .= '<a href="'.route('roles.permissions', ['id' => $role->id]).'" data-toggle="tooltip" data-placement="top" title="Editar permisos" class="btn btn-sm btn-primary"><i class="fa fa-lock"></i></a>&nbsp;';
            }
            return $buttons;
        }
        return $buttons;
    }

    /**
     * @param $id
     * @return $this
     */
    public function permissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $modules = Module::all();
        return view('users::roles.permissions')
            ->with('modules', $modules)
            ->with('permissions', $permissions)
            ->with('role', $role);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function permissionsUpdate(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        if($request->has('permissions'))
        {
            $role->perms()->sync($request->get('permissions'));
        }else{
            $role->perms()->sync([]);
        }
        SweetAlert::success('Se han actualizado los permisos del rol', 'Excelente!')->autoclose(3500);
        return redirect()->back();
    }

}