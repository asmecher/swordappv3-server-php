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
        $sd = new StatusDocument(
            id: 'my test id',
            fileSetId: 'http://fileset-id',
            fileSetEtag: 'xyz',
            service: 'http://service',
            metadataId: 'http://metadata-id',
            metadataEtag: 'abc',
            actions: new Actions()
        );
        $sd->addState(StatusDocument::STATE_IN_PROGRESS, 'In progress');

        $this->assertJsonMatchesSchema(json_decode(json_encode($sd)), 'swordv3/docs/status.schema.json');
    }

    public function testWithLink()
    {
        $sd = new StatusDocument(
            id: 'my test id',
            fileSetId: 'http://fileset-id',
            fileSetEtag: 'xyz',
            service: 'http://service',
            metadataId: 'http://metadata-id',
            metadataEtag: 'abc',
            actions: new Actions()
        );
        $sd->addState('http://purl.org/net/sword/3.0/state/inProgress', 'In progress');
        $sd->addLink(new Link(
            id: 'my test link id',
            contentType: 'application/pdf',
            eTag: 'abc',
            status: 'http://purl.org/net/sword/3.0/filestate/ingested'
        ));

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/status.schema.json');
    }
}
