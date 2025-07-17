<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->wantsJson();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'photoUrl' => ['required', 'string', 'max:255'],
            'serverAuthCode' => ['nullable', 'string', 'max:255'],
            'accessToken' => ['required', 'string'],
            'idToken' => ['nullable', 'string'],
            'source' => ['nullable', 'numeric'],
        ];
    }

    /**
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $errors = reset($errors)[0];
        $response = [
            'success' => false,
            'message' => $errors,
            'data' => [],
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }

}
