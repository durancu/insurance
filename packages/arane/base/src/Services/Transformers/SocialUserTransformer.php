<?php

namespace Arane\Base\Services\Transformers;

use Arane\Base\Models\Entities\User;

/**
 * Class SocialUserTransformerTransformer.
 *
 * @package namespace Arane\Base\Services\Transformers;
 */

use League\Fractal\TransformerAbstract;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class SocialUserTransformer extends TransformerAbstract {
    
    protected $providers = ['github', 'facebook', 'google', 'okta'];
    protected $user;
    
    function __construct($user) {
        $this->user = $user;
    }
    
    public function transform($provider) {
        if (in_array($provider, $this->providers)) {
            switch ($provider) {
                case 'github':
                case 'facebook':
                case 'google':
                case 'okta':
                default:
                    return $this->defaultUser();
            }
        }
        
        return new InvalidParameterException('Invalid OAuth Driver: ' . $provider);
    }
    
    protected function defaultUser() {
        if (isset($this->user->firstname) && isset($this->user->lastname)) {
            $firstname = $this->user->firstname;
            $lastname = $this->user->lastname;
        } else {
            $names = $this->separatedNames(isset($this->user->name) ? $this->user->name : '');
            $firstname = $names['firstname'];
            $lastname = $names['lastname'];
        }
        
        $userAttributes = [
            'email' => $this->user->email,
            'password' => str_random(8),
            'first_name' => $firstname,
            'last_name' => $lastname,
            'phone_number' => $lastname,
            'avatar' => isset($this->user->avatar) ? $this->user->avatar : ''
        ];
        
        return User::defaultTransformer($userAttributes);
    }
    
    
    protected function separatedNames($name) {
        $name = explode(' ', $name, 1);
        
        $firstname = '';
        $lastname = '';
        if (count($name)) {
            if (count($name) === 2) {
                $firstname = $name[0];
                $lastname = $name[1];
            } else {
                $firstname = $name[0];
            }
        }
        
        return ['firstname' => $firstname, 'lastname' => $lastname];
    }
    
}