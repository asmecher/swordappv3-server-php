<?php

namespace Asmecher\Swordv3Server;

class ServiceDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'ServiceDocument';
  const VERSION = 'http://purl.org/net/sword/3.0';

  public string $id;

  public string $title;
  public string $abstract;

  public string $root;
  public bool $acceptDeposits = true;

  public ?int $maxUploadSize = 16777216000;
  public ?int $maxByReferenceSize = 30000000000000000;
  public ?int $maxSegmentSize = 16777216000;
  public ?int $minSegmentSize = 1;
  public ?int $maxAssembledSize = 30000000000000;
  public ?int $maxSegments = 1000;

  public array $accept = ['*/*'];
  public array $acceptArchiveFormat = ['application/zip'];
  public array $acceptPackaging = ['*'];
  public array $acceptMetadata = ['http://purl.org/net/sword/3.0/types/Metadata'];

  public ?CollectionPolicy $collectionPolicy = null;
  public ?Treatment $treatment = null;

  public ?string $staging = null;
  public ?int $stagingMaxIdle = 3600;

  public bool $byReferenceDeposit = false;
  public bool $onBehalfOf = false;

  public array $digest = ['SHA-256', 'SHA', 'MD5'];
  public array $authentication = ['Basic', 'OAuth', 'Digest', 'APIKey'];

  protected array $services = [];

  public function __construct(string $id) {
    $this->id = $id;
  }

  public function addService(ServiceDocument $sd): self
  {
    $this->services[] = $sd;
    return $this;
  }

  public function jsonSerialize() {
    return array_filter([
      '@context' => self::CONTEXT,
      '@id' => $this->id,
      '@type' => self::TYPE,
      'dc:title' => $this->title,
      'dcterms:abstract' => $this->abstract,
      'root' => $this->root,
      'acceptDeposits' => $this->acceptDeposits,
      'version' => self::VERSION,
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
