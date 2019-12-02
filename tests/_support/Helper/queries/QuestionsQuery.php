<?php
/**
 * @description Object of class with description of questions request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class QuestionsQuery
{
    private $apiUrl;
    private $city;
    private $type;
    private $questionComment;
    private $email;
    private $name;
    private $questionText;

    public function __construct()
    {
        $this->setApiUrl(ApiUrls::QUESTIONS);
        $this->setCity('Москва');
        $this->setType(3);
        $this->setQuestionComment('');
        $this->setEmail($this->getRandomEmail());
        $this->setName('Иван Иванович Тестер');
        $this->setQuestionText("Этот вопрос сформирован автотестом.");
    }

    public function setApiUrl(string $apiUrl): QuestionsQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }

    public function setCity(string $city): QuestionsQuery
    {
        $this->city = $city;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setType(int $type): QuestionsQuery
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setQuestionComment(string $questionComment): QuestionsQuery
    {
        $this->questionComment = $questionComment;
        return $this;
    }

    public function getQuestionComment(): string
    {
        return $this->questionComment;
    }

    public function setEmail(string $email): QuestionsQuery
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setName(string $name): QuestionsQuery
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setQuestionText(string $questionText): QuestionsQuery
    {
        $this->questionText = $questionText;
        return $this;
    }

    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    private function getRandomEmail(): string
    {
        $prefix = (string) rand(100000, 999999);
        $generatePostfixNumber = '@test.test';
        return $prefix . $generatePostfixNumber;
    }
}