<?php

namespace Asmecher\Swordv3Server\Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;

use Asmecher\Swordv3Server\StatusDocument;
use Asmecher\Swordv3Server\Actions;
use Asmecher\Swordv3Server\Link;

class StatusDocumentTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    public function testDefaultStatusDocument()
    {
        $sd = new StatusDocument('my test id');
        $sd->fileSetId = 'http://fileset-id';
        $sd->fileSetEtag = 'xyz';
        $sd->service = 'http://service';
        $sd->addState('http://purl.org/net/sword/3.0/state/inProgress', 'In progress');
        $sd->metadataId = 'http://metadata-id';
        $sd->actions = new Actions();

        $this->assertJsonMatchesSchema(json_decode(json_encode($sd)), 'swordv3/docs/status.schema.json');
    }

    public function testWithLink()
    {
        $sd = new StatusDocument('my test id');
        $sd->fileSetId = 'http://fileset-id';
        $sd->fileSetEtag = 'xyz';
        $sd->service = 'http://service';
        $sd->addState('http://purl.org/net/sword/3.0/state/inProgress', 'In progress');
        $sd->metadataId = 'http://metadata-id';
        $sd->actions = new Actions();

        $link = new Link('my test link id');
        $link->contentType = 'application/pdf';
        $link->eTag = 'abc';
        $link->status = 'http://purl.org/net/sword/3.0/filestate/ingested';
        $sd->addLink($link);

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/status.schema.json');
    }
}
