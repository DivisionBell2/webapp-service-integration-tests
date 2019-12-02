<?php
/**
 * @description Object of class with description of questions list request
 */

namespace Helper\queries;

use Helper\ApiUrls;

class QuestionListQuery
{
    private $apiUrl;

    public function __construct()
    {
        $this->setApiUrl(ApiUrls::QUESTIONS_LIST);
    }

    public function setApiUrl(string $apiUrl): QuestionListQuery
    {
        $this->apiUrl = $apiUrl;
        return $this;
    }

    public function getApiUrl(): ?string
    {
        return $this->apiUrl;
    }
}