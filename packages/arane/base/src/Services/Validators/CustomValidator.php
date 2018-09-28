<?php

namespace Arane\Base\Services\Validators;

use Illuminate\Validation\Validator;

/**
 * Class CustomValidator
 *
 * @package Arane\Base\Services\Validators
 */
class CustomValidator extends Validator {
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     */
    public function validatePhone($attribute, $value, $parameters)
    {
        // Phone number should start with number 0-9 and can have minus, plus
        // and braces.
        return preg_match("/^([0-9\s\-\+\(\)]*)$/", $value);
    }
    
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     */
    public function validateMobile($attribute, $value, $parameters)
    {
        // Mobile number can start with plus sign and should start with number
        // and can have minus sign and should be between 9 to 12 character long.
        return preg_match("/^\+?\d[0-9-]{9,12}/", $value);
    }
    
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     */
    public function validateCsv($attribute, $value, $parameters)
    {
        // Valide comman separated value.
        return preg_match("/[A-Za-z0-9\s]+(,[A-Za-z0-9\s]+)*[A-Za-z0-9]$/", $value);
    }
    
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return false|int
     */
    public function validateMonthYear($attribute, $value, $parameters)
    {
        // Can have 3 letter month name as string followed by 4 letter year
        // number.
        return preg_match("/^(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sept|Oct|Nov|Dec)-[0-9]{4}$/i", $value);
    }
}