<?php

namespace Arane\Email\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class EmailContactSendRequest extends BaseFormRequest {
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
            'from-email' => 'required|string|email',
            'from-name' => 'nullable|string',
            'subject' => 'nullable|string',
            'message' => 'required|string|min:50',
            'reason' => 'required|string',
            'attachment' => 'nullable|file',
            'phone-number' => 'nullable',
        ];
    }
}
