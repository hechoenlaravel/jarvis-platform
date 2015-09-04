<?php namespace Modules\Installer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'db_host' => 'required',
            'db_user' => 'required',
            'db_pass' => 'required',
            'db_name' => 'required',
		];
	}

}
