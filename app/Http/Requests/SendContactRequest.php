<?php
/**
 * Created by PhpStorm.
 * User: Duran
 * Date: 9/24/18
 * Time: 6:16 AM
 */

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SendContactRequest extends BaseFormRequest {
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
            'g-recaptcha-response' => 'required|recaptcha',
            'from-name' => 'required|string|max:255',
            'from-email' => 'required|email',
            'phone-number' => 'nullable',
            'subject' => 'nullable|string',
            'message' => 'required|string|min:6',
            'reason' => 'nullable|string'
        ];
    }
    
    protected function failedValidation(Validator $validator) {
        
        parent::failedValidation($validator);
    }
}