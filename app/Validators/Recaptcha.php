<?php


namespace App\Validators;

use GuzzleHttp\Client;

/**
 * Class ReCaptcha
 *
 * @package App\Validators
 */
class ReCaptcha {
    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return mixed
     */
    public function validate($attribute, $value, $parameters, $validator) {
        $client = new Client();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify',
            ['form_params' =>
                [
                    'secret' => config('services.google.recaptcha_secret'),
                    'response' => $value
                ]
            ]
        );
        $body = json_decode((string)$response->getBody());
        
        return $body->success;
    }
}
