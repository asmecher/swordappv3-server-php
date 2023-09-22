<?php

namespace Asmecher\Swordv3Server;

class ServiceDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'ServiceDocument';
  const VERSION = 'http://purl.org/net/sword/3.0';

  const DEFAULT_MAX_UPLOAD_SIZE = 16777216000;
  const DEFAULT_MAX_BY_REFERENCE_SIZE = 30000000000000000;
  const DEFAULT_MAX_SEGMENT_SIZE = 16777216000;
  const DEFAULT_MIN_SEGMENT_SIZE = 1;
  const DEFAULT_MAX_ASSEMBLED_SIZE = 30000000000000;
  const DEFAULT_MAX_SEGMENTS = 1000;

  const DEFAULT_ACCEPTS = ['*/*'];
  const DEFAULT_ACCEPT_ARCHIVE_FORMAT = ['application/zip'];
  const DEFAULT_ACCEPT_PACKAGING = ['*'];
  const DEFAULT_ACCEPT_METADATA = ['http://purl.org/net/sword/3.0/types/Metadata'];

  const DEFAULT_STAGING_MAX_IDLE = 3600;

  const DEFAULT_DIGEST = ['SHA-256', 'SHA', 'MD5'];
  const DEFAULT_AUTHENTICATION = ['Basic', 'OAuth', 'Digest', 'APIKey'];

  public function __construct(
    public string $id,
    public string $title,
    public string $abstract,
    public string $root,
    public bool $acceptDeposits = true,

    public ?int $maxUploadSize = self::DEFAULT_MAX_UPLOAD_SIZE,
    public ?int $maxByReferenceSize = self::DEFAULT_MAX_BY_REFERENCE_SIZE,
    public ?int $maxSegmentSize = self::DEFAULT_MAX_SEGMENT_SIZE,
    public ?int $minSegmentSize = self::DEFAULT_MIN_SEGMENT_SIZE,
    public ?int $maxAssembledSize = self::DEFAULT_MAX_ASSEMBLED_SIZE,
    public ?int $maxSegments = self::DEFAULT_MAX_SEGMENTS,

    public array $accept = self::DEFAULT_ACCEPTS,
    public array $acceptArchiveFormat = self::DEFAULT_ACCEPT_ARCHIVE_FORMAT,
    public array $acceptPackaging = self::DEFAULT_ACCEPT_PACKAGING,
    public array $acceptMetadata = self::DEFAULT_ACCEPT_METADATA,

    public ?CollectionPolicy $collectionPolicy = null,
    public ?Treatment $treatment = null,

    public ?string $staging = null,
    public ?int $stagingMaxIdle = self::DEFAULT_STAGING_MAX_IDLE,

    public bool $byReferenceDeposit = false,
    public bool $onBehalfOf = false,

    public array $digest = self::DEFAULT_DIGEST,
    public array $authentication = self::DEFAULT_AUTHENTICATION,

    protected array $services = []
  ) {
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
