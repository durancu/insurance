<?php

namespace Arane\Email\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class EmailListCreateRequest extends BaseFormRequest {
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
            //'name', 'description', 'emails', 'slug'
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'emails' => 'required|max:255',
            'slug' => 'required|max:255'
        ];
    }
}
