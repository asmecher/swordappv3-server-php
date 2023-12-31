<?php

namespace Asmecher\Swordv3Server\Tests;

use EnricoStahn\JsonAssert\Assert as JsonAssert;

use Asmecher\Swordv3Server\ServiceDocument;
use Asmecher\Swordv3Server\CollectionPolicy;
use Asmecher\Swordv3Server\Treatment;

class ServiceDocumentTest extends \PHPUnit\Framework\TestCase
{
    use JsonAssert;

    public function testDefaultServiceDocument()
    {
        $sd = new ServiceDocument(
            id: 'my test id',
            title: 'My test title',
            abstract: 'My test abstract',
            root: 'http://test-service-document'
        );

        $this->assertJsonMatchesSchema(json_decode(json_encode($sd)), 'swordv3/docs/service-document.schema.json');
    }

    public function testWithCollectionPolicy()
    {
        $sd = new ServiceDocument(
            id: 'my test id',
            title: 'My test title',
            abstract: 'My test abstract',
            root: 'http://test-service-document'
        );

        $sd->collectionPolicy = new CollectionPolicy(
            id: 'http://collection-policy',
            description: 'A collection policy...'
        );

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('http://collection-policy', $decodedEncodedJson->collectionPolicy->{'@id'});
        $this->assertEquals('A collection policy...', $decodedEncodedJson->collectionPolicy->description);
    }

    public function testWithTreatment()
    {
        $sd = new ServiceDocument(
            id: 'my test id',
            title: 'My test title',
            abstract: 'My test abstract',
            root: 'http://test-service-document'
        );

        $sd->treatment = new Treatment(
            id: 'http://treatment',
            description: 'A treatment...'
        );

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('http://treatment', $decodedEncodedJson->treatment->{'@id'});
        $this->assertEquals('A treatment...', $decodedEncodedJson->treatment->description);
    }

    public function testWithServices()
    {
        $sd = new ServiceDocument(
            id: 'my test id',
            title: 'My test title',
            abstract: 'My test abstract',
            root: 'http://test-service-document'
        );

        // Clone the service document and modify it for a nested service
        $subSd = clone $sd;
        $subSd->id = 'my nested service document id';
        $sd->addService($subSd);

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('my nested service document id', $decodedEncodedJson->services[0]->{'@id'});
    }
}
