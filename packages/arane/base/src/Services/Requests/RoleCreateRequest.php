<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class RoleCreateRequest extends BaseFormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|unique:roles',
            'display_name' => 'required|unique:roles,display_name'
        ];
    }
}
