<?php namespace Modules\Users\Http\Controllers;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use JavaScript;
use Pingpong\Modules\Routing\Controller;
use Hechoenlaravel\JarvisFoundation\UI\Field\FormBuilder;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

class ConfigController extends Controller {
	
	public function index()
	{
        $entity = EntityModel::where('slug', 'users')->firstOrFail();
        JavaScript::put([
            'entity_id' => $entity->id
        ]);
		return view('users::config.index');
	}

    public function createField()
    {
        $entity = EntityModel::where('slug', 'users')->firstOrFail();
        $builder = new FormBuilder($entity);
        $builder->setReturnUrl(route('users.config'));
        JavaScript::put([
            'entity_id' => $entity->id
        ]);
        return view('users::config.create')
            ->with('form', $builder->render());
    }

    public function editField($id)
    {
        $field = FieldModel::findOrFail($id);
        $entity = $field->entity;
        $builder = new FormBuilder($entity);
        $builder->setReturnUrl(route('users.config'));
        $builder->setModel($field);
        JavaScript::put([
            'entity_id' => $entity->id
        ]);
        return view('users::config.edit')
            ->with('form', $builder->render());
    }
	
}