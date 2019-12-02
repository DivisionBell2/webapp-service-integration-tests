<?php
/**
 * @description Object of class with description of register user request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class UserRegisterQuery
{
    private $name;
    private $email;
    private $phone;
    private $password;
    private $sex;
    private $subscribe;
    private $smsSubscribe;

    public function __construct()
    {
        $this->setEmail($this->getRandomEmail());
        $this->setPhone($this->getRandomPhoneNumber());
        $this->setPassword('123456789');
        $this->setSex('1');
        $this->setSubscribe('true');
        $this->setSmsSubscribe('true');
        $this->setName('Тестер Тестович');
    }

    public function getFinalApiUrl(): string
    {
        return ApiUrls::REGISTER;
    }

    public function setName(string $name): UserRegisterQuery
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setEmail(string $email): UserRegisterQuery
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPhone(string $phone): UserRegisterQuery
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPassword(string $password): UserRegisterQuery
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setSex(int $sex): UserRegisterQuery
    {
        $this->sex = $sex;
        return $this;
    }

    public function getSex(): int
    {
        return $this->sex;
    }

    public function setSubscribe(bool $subscribe): UserRegisterQuery
    {
        $this->subscribe = $subscribe;
        return $this;
    }

    public function getSubscribe(): bool
    {
        return $this->subscribe;
    }

    public function setSmsSubscribe(bool $smsSubscribe): UserRegisterQuery
    {
        $this->smsSubscribe = $smsSubscribe;
        return $this;
    }

    public function getSmsSubscribe(): bool
    {
        return $this->smsSubscribe;
    }

    private function getRandomEmail(): string
    {
        $prefix = (string) rand(100000, 999999);
        $generatePostfixNumber = '@test.test';
        return $prefix . $generatePostfixNumber;
    }

    private function getRandomPhoneNumber(): string
    {
        $prefix = 900;
        $generatePostfix1 = rand(100, 999);
        $generatePostfix2 = rand(10, 99);
        $generatePostfix3 = rand(10, 99);
        return '+7' . "({$prefix})" . $generatePostfix1 . '-' . $generatePostfix2 . '-' . $generatePostfix3;
    }
}
