<?php

namespace Arane\Sharepoint\Services\Requests;

use App\Http\Requests\BaseFormRequest;

use Illuminate\Validation\Rule;

class SharepointShareRequest extends BaseFormRequest {
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
            'users' => 'required|array|min:1',
            'permission' => ['required', Rule::in('r', 'w', 'o')]
        ];
    }
}
