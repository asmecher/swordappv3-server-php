<?php

namespace Asmecher\Swordv3Server;

class ServiceDocument implements \JsonSerializable {
  public string $context = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  public string $id;
  public string $type = "ServiceDocument";

  public string $title;
  public string $abstract;

  public string $root;
  public bool $acceptDeposits = true;

  public string $version = 'http://purl.org/net/sword/3.0';
  public int $maxUploadSize = 16777216000;
  public int $maxByReferenceSize = 30000000000000000;
  public int $maxSegmentSize = 16777216000;
  public int $minSegmentSize = 1;
  public int $maxAssembledSize = 30000000000000;
  public int $maxSegments = 1000;

  public array $accept = ['*/*'];
  public array $acceptArchiveFormat = ['application/zip'];
  public array $acceptPackaging = ['*'];
  public array $acceptMetadata = ['http://purl.org/net/sword/3.0/types/Metadata'];

  public ?CollectionPolicy $collectionPolicy = null;
  public ?Treatment $treatment = null;

  public string $staging;
  public int $stagingMaxIdle = 3600;

  public bool $byReferenceDeposit = false;
  public bool $onBehalfOf = false;

  public array $digest = ['SHA-256', 'SHA', 'MD5'];
  public array $authentication = ['Basic', 'OAuth', 'Digest', 'APIKey'];

  public array $services = [];

  public function __construct(string $id) {
    $this->id = $id;
  }

  public function jsonSerialize() {
    return array_filter([
      '@context' => $this->context,
      '@id' => $this->id,
      '@type' => $this->type,
      'dc:title' => $this->title,
      'dcterms:abstract' => $this->abstract,
      'root' => $this->root,
      'acceptDeposits' => $this->acceptDeposits,
      'version' => $this->version,
      'maxUploadSize' => $this->maxUploadSize,
      'maxByReferenceSize' => $this->maxByReferenceSize,
      'maxSegmentSize' => $this->maxSegmentSize,
      'minSegmentSize' => $this->minSegmentSize,
      'maxAssembledSize' => $this->maxAssembledSize,
      'maxSegments' => $this->maxSegments,
      'accept' => $this->accept,
      'acceptArchiveFormat' => $this->acceptArchiveFormat,
      'acceptPackaging' => $this->acceptPackaging,
      'acceptMetadata' => $this->acceptMetadata,
      'collectionPolicy' => $this->collectionPolicy,
      'treatment' => $this->treatment,
      'staging' => $this->staging,
      'stagingMaxIdle' => $this->stagingMaxIdle,
      'byReferenceDeposit' => $this->byReferenceDeposit,
      'onBehalfOf' => $this->onBehalfOf,
      'digest' => $this->digest,
      'authentication' => $this->authentication,
      'services' => $this->services,
    ], fn($e) => $e !== null);
  }
}
