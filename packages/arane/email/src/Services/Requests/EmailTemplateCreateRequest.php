<?php

namespace Arane\Email\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class EmailTemplateCreateRequest extends BaseFormRequest {
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
            //'name', 'type', 'path', 'fields', 'description', 'format'
            'name' => 'required|max:255',
            'type' => 'max:255',
            'path' => 'required|max:255',
            'fields' => 'required|max:255',
            'description' => 'required|max:255',
            'format' => 'max:255'
        ];
    }
}
