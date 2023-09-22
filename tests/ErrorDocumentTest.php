<?php

namespace Asmecher\Swordv3Server\Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;

use Asmecher\Swordv3Server\ErrorDocument;
use Asmecher\Swordv3Server\CollectionPolicy;
use Asmecher\Swordv3Server\Treatment;

use DateTimeImmutable;

class ErrorDocumentTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    public function testErrorDocument()
    {
        $ed = new ErrorDocument(
            type: 'BadRequest',
            timestamp: new DateTimeImmutable(),
            error: 'Error summary',
            log: 'text log of any debug information for the client'
        );

        $this->assertJsonMatchesSchema(json_decode(json_encode($ed)), 'swordv3/docs/error.schema.json');
    }
}
