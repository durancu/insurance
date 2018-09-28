<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class UserLoginRequest extends BaseFormRequest {
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
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ];
    }
}
