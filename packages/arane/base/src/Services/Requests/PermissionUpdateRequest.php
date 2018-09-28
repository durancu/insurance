<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class PermissionUpdateRequest extends BaseFormRequest {
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
            'key' => 'unique:permissions',
            'table_name' => 'sometimes|alpha_dash',
            'display_name' => 'unique:permissions,display_name'
        ];
    }
}
