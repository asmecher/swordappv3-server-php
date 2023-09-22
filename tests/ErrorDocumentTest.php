<?php

namespace Asmecher\Swordv3Server\Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;

use Asmecher\Swordv3Server\ErrorDocument;
use Asmecher\Swordv3Server\ErrorTypes;

use DateTimeImmutable;

class ErrorDocumentTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    public function testErrorDocument()
    {
        $ed = new ErrorDocument(
            type: ErrorTypes::BAD_REQUEST,
            timestamp: new DateTimeImmutable(),
            error: 'Error summary',
            log: 'text log of any debug information for the client'
        );

        $this->assertJsonMatchesSchema(json_decode(json_encode($ed)), 'swordv3/docs/error.schema.json');
        $this->assertEquals(400, $ed->type->getErrorCode());
        $this->assertEquals('BadRequest', $ed->type->getHTTPName());
    }
}
