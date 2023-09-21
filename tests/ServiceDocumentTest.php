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
        $sd = new ServiceDocument('my test id');
        $sd->title = 'My test title';
        $sd->abstract = 'My test abstract';
        $sd->root = 'http://test-service-document';

        $this->assertJsonMatchesSchema(json_decode(json_encode($sd)), 'swordv3/docs/service-document.schema.json');
    }

    public function testWithCollectionPolicy()
    {
        $sd = new ServiceDocument('my test id');
        $sd->title = 'My test title';
        $sd->abstract = 'My test abstract';
        $sd->root = 'http://test-service-document';

        $sd->collectionPolicy = new CollectionPolicy();
        $sd->collectionPolicy->id = 'http://collection-policy';
        $sd->collectionPolicy->description = 'A collection policy...';

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('http://collection-policy', $decodedEncodedJson->collectionPolicy->{'@id'});
        $this->assertEquals('A collection policy...', $decodedEncodedJson->collectionPolicy->description);
    }

    public function testWithTreatment()
    {
        $sd = new ServiceDocument('my test id');
        $sd->title = 'My test title';
        $sd->abstract = 'My test abstract';
        $sd->root = 'http://test-service-document';

        $sd->treatment = new Treatment();
        $sd->treatment->id = 'http://treatment';
        $sd->treatment->description = 'A treatment...';

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('http://treatment', $decodedEncodedJson->treatment->{'@id'});
        $this->assertEquals('A treatment...', $decodedEncodedJson->treatment->description);
    }

    public function testWithServices()
    {
        $sd = new ServiceDocument('my test id');
        $sd->title = 'My test title';
        $sd->abstract = 'My test abstract';
        $sd->root = 'http://test-service-document';

        $subSd = clone $sd;
        $subSd->id = 'my nested service document id';
        $sd->addService($subSd);

        $decodedEncodedJson = json_decode(json_encode($sd));

        $this->assertJsonMatchesSchema($decodedEncodedJson, 'swordv3/docs/service-document.schema.json');

        $this->assertEquals('my nested service document id', $decodedEncodedJson->services[0]->{'@id'});
    }
}
