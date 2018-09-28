<?php

namespace Arane\File\Services\Requests;

use App\Http\Requests\BaseFormRequest;

use Illuminate\Validation\Rule;

class FileCreateRequest extends BaseFormRequest {
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
            'file' => 'required',
            'name' => 'max:255',
            'path' => 'max:255',
            'disk' => Rule::in(['s3', 'public', 'local'])
        ];
    }

    function messages() {
        return [
            'file.required' => 'Email is a required field',
            'name.max' => 'First name maximum length is 255 characters',
            'path.max' => 'First name maximum length is 255 characters',
            'disk.in' => 'Disk most be s3, public or local',

            'email.email' => 'Email is not valid',
            'password' => 'Password is a required field',
            'first_name.required' => 'First name is required',
            'first_name.alpha' => 'First name can only contain letters',

            'last_name.required' => 'Last name is required',
            'last_name.alpha' => 'Last name can only contain letters',
            'last_name.max' => 'Last name maximum length is 255 characters',
        ];
    }
}
