<?php
/**
 * @description Object of class with description of change password request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class ChangePasswordQuery
{
    private $apiUrl;
    private $oldPassword;
    private $newPassword;

    public function __construct(string $oldPassword)
    {
        $this->setApiUrl(ApiUrls::PROFILE_PASSWORD);
        $this->setOldPassword($oldPassword);
        $this->setNewPassword($this->getRandomPassword());
    }

    public function setApiUrl(string $apiUrl): ChangePasswordQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setOldPassword(string $oldPassword): ChangePasswordQuery
    {
        $this->oldPassword = $oldPassword;
        return $this;
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function setNewPassword(string $newPassword): ChangePasswordQuery
    {
        $this->newPassword = $newPassword;
        return $this;
    }

    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    private function getRandomPassword(): string
    {
        $password = '';
        $chars = '0123456789abcdefghijklmnopqrstuvwxyz';

        for ($i = 0; $i < 10; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $password;
    }
}