<?php
/**
 * @description Basic query for new feedback question response
 */

namespace questions;

use Helper\requesters\guzzle\QuestionsRequester;
use Codeception\Util\Shared\Asserts;
use Helper\GuzzleClientHelper;
use Helper\queries\QuestionsQuery;

class AddQuestionResponseCheckCest
{
    use Asserts;

    public function testAddQuestionResponseCheckCest(\ApiTester $I)
    {
        $client = (new GuzzleClientHelper())->getClient();

        $queryObj = new QuestionsQuery();
        $question = (new QuestionsRequester($I, $client))->makeQuestionsRequest($queryObj);

        $this->assertIsString($question['city'], 'Not a string');

        $this->assertIsString($question['name'], 'Not a string');

        $this->assertIsString($question['email'], 'Not a string');

        $this->assertNull($question['phone'], 'Not null');

        $this->assertIsInt($question['type'], 'Not an integer');

        $thread = $question['thread'][0];

        $this->assertIsArray($thread, 'Not an array');

        $this->assertIsString($thread['question_text'], 'Not a string');

        $this->assertIsString($thread['question_created_at'], 'Not a string');

        $this->assertNull($thread['answer_text'], 'Not null');

        $this->assertNull($thread['answer_created_at'], 'Not null');

        $this->assertIsBool($thread['answer_publication_status'], 'Not a bool');

        $this->assertIsInt($thread['question_type'], 'Not an integer');

        $this->assertNull($thread['question_product_sku'], 'Not null');

        $this->assertIsBool($thread['question_publication_status'], 'Not a bool');

        $this->assertNull($thread['answer_user_id'], 'Not null');

        $this->assertIsInt($thread['sort_id'], 'Not an integer');

        $this->assertIsString($thread['_id'], 'Not a string');

        $this->assertIsInt($question['status'], 'Not an integer');

        $this->assertIsInt($question['thread_type'], 'Not an integer');

        $this->assertIsBool($question['thread_publication_status'], 'Not a bool');

        $this->assertIsString($question['question_comment'], 'Not a string');

        $this->assertIsInt($question['_id'], 'Not an integer');

        $this->assertIsString($question['updated_at'], 'Not a string');

        $this->assertIsString($question['created_at'], 'Not a string');
    }
}