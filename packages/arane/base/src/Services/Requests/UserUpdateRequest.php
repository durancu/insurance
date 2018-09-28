<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class UserUpdateRequest extends BaseFormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    
    public function validate() {
        // TODO: Implement validate() method.
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'email' => 'email|unique:users',
            'password' => 'string|min:6',
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            //'phone_number' => 'nullable',
            'avatar' => 'url|nullable'
        ];
    }
}
