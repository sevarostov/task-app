<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, ValidationRule|array|string>
	 */
	public function rules(): array
	{
		return [
			'title' => $this->isMethod('POST')
				? 'required|string|min:1|max:255'
				: 'sometimes|string|min:1|max:255',
			'description' => 'nullable|string|max:512',
			'status' => 'string|required|max:64',
		];
	}

	/**
	 * Error messages
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'title.required' => 'The "title" field is required.',
			'title.min' => 'The "title" field must not be empty.',
			'title.max' => 'The "title" field cannot exceed :max characters.',
			'description.max' => 'The "description" field cannot exceed :max characters.',
			'status.max' => 'The "status" field cannot exceed :max characters.'
		];
	}

	/**
	 * Interception and handling of validation errors
	 *
	 * @param Validator $validator
	 * @throws HttpResponseException
	 *
	 * @return mixed
	 */
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json(
			['errors' => $validator->errors()], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
		));
	}
}
