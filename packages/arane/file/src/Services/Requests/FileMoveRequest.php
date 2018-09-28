<?php

namespace Arane\File\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class FileMoveRequest extends BaseFormRequest {
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
            //
            'name' => 'max:255',
            'path' => 'required|max:255'
        ];
    }
}
