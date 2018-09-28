<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class CountryCreateRequest extends BaseFormRequest {
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
            'name' => 'required|string',
            'nice_name' => 'required|string',
            'iso' => 'required|size:2|alpha',
            'iso_3' => 'required|size:3|alpha',
            'num_code' => 'numeric',
            'phone_code' => 'numeric',
        ];
    }
}
