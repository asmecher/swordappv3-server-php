<?php

namespace Asmecher\Swordv3Server\Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;

use Asmecher\Swordv3Server\MetadataDocument;

class MetadataDocumentTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    public function testDefaultMetadataDocument()
    {
        $md = new MetadataDocument('my test id');

        $this->assertJsonMatchesSchema(json_decode(json_encode($md)), 'swordv3/docs/metadata.schema.json');
    }

    public function testWithTreatment()
    {
        $md = new MetadataDocument('my test id');
        $md->addMetadata('dc:title', 'My test title');

        $decodedEncodedJson = json_decode(json_encode($md));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/metadata.schema.json');

        $this->assertEquals('My test title', $decodedEncodedJson->{'dc:title'});
    }
}
