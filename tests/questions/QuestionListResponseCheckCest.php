<?php
/**
 * @description Basic query for feedback asks and answers response
 */

namespace questions;

use Helper\queries\QuestionListQuery;
use Helper\requesters\codeception\QuestionListRequester;
use Helper\Arrays;

class QuestionListResponseCheckCest
{
    public function testQuestionListResponseCheckCest(\ApiTester $I)
    {
        $queryObj = new QuestionListQuery();
        (new QuestionListRequester($I))->makeQuestionListRequest($queryObj);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();

        $questions = $I->grabDataFromResponseByJsonPath('$.')[0];
        Arrays::checkForEmptyArray($questions, 'Questions list must be in response');

        $I->seeResponseMatchesJsonType([
            'current_page' => 'integer:>0',
            'data' => 'array',
            'from' => 'integer:>0',
            'last_page' => 'integer:>0',
            'next_page_url' => 'string|null',
            'path' => 'string:url',
            'per_page' => 'integer:>0',
            'prev_page_url' => 'string|null',
            'to' => 'integer:>0',
            'total' => 'integer:>0'
        ], "$.");

        if (isset($questions['data']) && count($questions['data']) > 0) {
            $data = $questions['data'];

            foreach ($data as $dataKey => $dataItem) {
                $I->seeResponseMatchesJsonType([
                    '_id' => 'integer:>0',
                    'city' => 'string',
                    'name' => 'string',
                    'email' => 'string:email',
                    'phone' => 'integer|null',
                    'type' => 'integer:>0',
                    'thread' => 'array',
                    'status' => 'integer:>0',
                    'thread_type' => 'integer|null',
                    'thread_publication_status' => 'boolean',
                    'question_comment' => 'string|null',
                    'updated_at' => 'string',
                    'created_at' => 'string'
                ], "$.data[$dataKey]");

                if(isset($dataItem['thread']) && count($dataItem['thread']) > 0) {
                    $thread = $dataItem['thread'];

                    foreach ($thread as $threadKey => $threadItem) {
                        $I->seeResponseMatchesJsonType([
                            'question_text' => 'string',
                            'question_created_at' => [
                                '$date' => [
                                    '$numberLong' => 'string'
                                ]
                            ],
                            'answer_text' => 'string',
                            'answer_created_at' => [
                                '$date' => [
                                    '$numberLong' => 'string'
                                ]
                            ],
                            'answer_publication_status' => 'boolean',
                            'question_type' => 'integer|null',
                            'question_product_sku' => 'string|null',
                            'question_publication_status' => 'boolean',
                            'answer_user_id' => 'string|null',
                            'sort_id' => 'integer|null',
                            '_id' => [
                                '$oid' => 'string'
                            ]
                        ], "$.data[$dataKey].thread[$threadKey]");
                    }
                }
            }
        }

    }
}