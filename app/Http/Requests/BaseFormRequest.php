<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Yoeunes\Toastr\Facades\Toastr;

class BaseFormRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }
    
    protected function failedValidation(Validator $validator) {
        $messages = $validator->messages();
        
        foreach ($messages->all() as $message) {
            Toastr::error($message, 'Failed', ['timeOut' => 10000]);
        }
        
        parent::failedValidation($validator);
    }
}