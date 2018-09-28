<?php

namespace Arane\File\Services\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class FileValidator.
 *
 * @package namespace Arane\File\Services\Validators;
 */
class FileValidator extends LaravelValidator {
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
