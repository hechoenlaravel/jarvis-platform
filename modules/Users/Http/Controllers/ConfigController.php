<?php namespace Modules\Users\Http\Controllers;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use JavaScript;
use Pingpong\Modules\Routing\Controller;
use Hechoenlaravel\JarvisFoundation\UI\Field\FormBuilder;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class ConfigController
 * @package Modules\Users\Http\Controllers
 */
class ConfigController extends Controller {

    /**
     * List the users settings
     * @return \Illuminate\View\View
     */
    public function index()
	{
        $entity = EntityModel::where('slug', 'users')->firstOrFail();
        JavaScript::put([
            'entity_id' => $entity->id
        ]);
		return view('users::config.index');
	}

    /**
     * Create a field for the user
     * @return $this
     */
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

    /**
     * Edit a field for the user
     * @param $id
     * @return $this
     */
    public function editField($id)
    {
        $field = FieldModel::findOrFail($id);
        $entity = $field->entity;
        $builder = new FormBuilder($entity);
        $builder->setReturnUrl(route('users.config'));
        $builder->setModel($field);
        JavaScript::put([
            'entity_id' => $entity->id,
            'field_id' => $field->id
        ]);
        return view('users::config.edit')
            ->with('form', $builder->render());
    }
	
}