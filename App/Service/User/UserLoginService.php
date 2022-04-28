<?php
declare(strict_types=1);

namespace App\Service\User;
use App\Validation\LoginValidation;
use Exception;
use src\Utility\Sanitizer;

class UserLoginService implements UserLoginServiceInterface
{
    private LoginValidation $validation;

    public function __construct(LoginValidation $validation)
    {
        $this->validation = $validation;
    }

    /**
     * @param array $data
     * @return array|null
     * @throws Exception
     */
    public function login(array $data): ?array
    {
        $sanitized = Sanitizer::clean($data);
        return $this->validation->validate($sanitized);
    }
}