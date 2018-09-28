<?php

namespace Arane\Base\Services\Requests;

use App\Http\Requests\BaseFormRequest;


class SearchRequest extends BaseFormRequest {
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
     * * @param array|integer|string id
     * @param array columns
     * @param string|array order
     * @param int limit
     * @param boolean no-paginate
     * @param array condition
     * @param string scope
     * @param array relationships
     *
     * @return array
     */
    public function rules() {
        return [
            'options' => 'nullable|array',
            'options.id' => '',
            'options.columns' => 'array',
            'options.order' => '',
            'options.limit' => 'numeric',
            'options.no-paginate' => 'boolean',
            'options.condition' => 'array',
            'options.scope' => 'string',
            'options.relationships' => 'array',
        ];
    }
}
