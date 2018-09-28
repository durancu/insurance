<?php

namespace Arane\Base\Services\Rules;

use Illuminate\Contracts\Validation\Rule;

class Mobile implements Rule {
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }
    
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        // Mobile number can start with plus sign and should start with number
        // and can have minus sign and should be between 9 to 12 character long.
        return preg_match("/^\+?\d[0-9-]{9,12}/", $value);
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        return 'The value :attribute is not a valid mobile phone number.';
    }
}
