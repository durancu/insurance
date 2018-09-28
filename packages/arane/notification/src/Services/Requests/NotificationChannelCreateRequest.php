<?php

namespace Arane\Notification\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class NotificationChannelCreateRequest extends BaseFormRequest {
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
            'name' => 'required | string',
            'display_name' => 'required | string',
        ];
    }
}
