<?php namespace Modules\Users\Http\Controllers;

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
        return view('users::config.create')->with('form', $builder->render());
    }
	
}