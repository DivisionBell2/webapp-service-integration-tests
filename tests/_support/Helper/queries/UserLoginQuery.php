<?php
/**
 * @description Object of class with description of Login user request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class UserLoginQuery
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getFinalApiUrl(): string
    {
        return ApiUrls::MOBILE_LOGIN;
    }

    public function setEmail(string $email): UserLoginQuery
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword(string $password): UserLoginQuery
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}