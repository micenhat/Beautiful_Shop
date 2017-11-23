<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'Parent' => 'required',
			'txtName' => 'required|unique:products,name',
			'fImages' => 'required|image'
		];
	}
	public function messages(){
		return [
			'Parent.required' => 'Please choose Category',
			'txtName.required' => 'Please Enter Name Product',
			'txtName.unique' => 'Product Name is Exist',
			'fImages.required' => 'Please choose Images',
			'fImages.image' => 'This File Is Not Images'



		];
	}
}
