<?php

namespace Modules\Users\Http\Controllers;

use Auth;
use Datatables;
use SweetAlert;
use Illuminate\Http\Request;
use Modules\Users\Entities\Role;
use Modules\Users\Http\Requests\CreateRoleRequest;
use yajra\Datatables\Html\Builder;
use Pingpong\Modules\Routing\Controller;

class RolesController extends Controller
{

    /**
     * Datatables Html Builder
     * @var Builder
     */
    protected $htmlBuilder;

    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }

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

    public function create()
    {
        return view('users::roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        Role::create($request->all());
        SweetAlert::success('Se ha creado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('users::roles.edit')->with('role', $role);
    }

    public function update(CreateRoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->fill($request->all());
        $role->save();
        SweetAlert::success('Se ha actualizado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        SweetAlert::success('Se ha eliminado el rol', 'Excelente!')->autoclose(3500);
        return redirect()->route('roles.index');
    }

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
            return $buttons;
        }
        return $buttons;
    }

}