<?php
/**
 * @description Object of class with description of reset password request
 */

namespace _support\Helper\queries;

use Helper\ApiUrls;

class ResetPasswordQuery
{
    private $apiUrl;
    private $email;

    public function __construct(string $email)
    {
        $this->setApiUrl(ApiUrls::RESET_PASSWORD);
        $this->setEmail($email);
    }

    public function setApiUrl(string $apiUrl): ResetPasswordQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setEmail(string $email): ResetPasswordQuery
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}