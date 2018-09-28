<?php

namespace Arane\Email\Services\Requests;

use App\Http\Requests\BaseFormRequest;

use Illuminate\Validation\Rule;

class EmailCreateRequest extends BaseFormRequest {
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
            'email' => 'required',
            'name' => 'max:255',
            'disk' => Rule::in(['s3', 'local', 'public'])
        ];
    }
}
