<?php

namespace Asmecher\Swordv3Server;

/**
 * A representation of a SWORD v3 Service Document.
 *
 * Buld this class as follows:
 * ```php
 * $serviceDocument = new ServiceDocument(
 *   id: 'http://example.com/service-document',
 *   title: 'Site Name',
 *   abstract: 'Site Description',
 *   root: 'http://example.com/service-document',
 *   collectionPolicy: new CollectionPolicy(...),
 *   ...
 * );
 * ```
 * Convert the object to JSON using `json_serialize`.
 *
 * See [9.2. Service Document](https://swordapp.github.io/swordv3/swordv3.html#9.2) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
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
    /** The URL of the service document you are looking at */
    public string $id,
    /** The title or name of the Service */
    public string $title,
    /** A description of the service */
    public string $abstract,
    /** The URL for the root Service Document. */
    public string $root,
    /** Does the Service accept deposits? */
    public bool $acceptDeposits = true,

    /** Maximum number of segments that the server will accept for a single segmented upload, if segmented upload is supported. */
    public ?int $maxUploadSize = self::DEFAULT_MAX_UPLOAD_SIZE,
    /** Maximum size in bytes as an integer for files uploaded by reference. */
    public ?int $maxByReferenceSize = self::DEFAULT_MAX_BY_REFERENCE_SIZE,
    /** Maximum size in bytes as an integer for an individual segment in a segmented upload */
    public ?int $maxSegmentSize = self::DEFAULT_MAX_SEGMENT_SIZE,
    /** Minimum size in bytes as an integer for an individual segment in a segmented upload */
    public ?int $minSegmentSize = self::DEFAULT_MIN_SEGMENT_SIZE,
    /** Maximum size in bytes as an integer for the total size of an assembled segmented upload */
    public ?int $maxAssembledSize = self::DEFAULT_MAX_ASSEMBLED_SIZE,
    /** Maximum number of segments that the server will accept for a single segmented upload, if segmented upload is supported. */
    public ?int $maxSegments = self::DEFAULT_MAX_SEGMENTS,

    /** List of Content Types which are acceptable to the server. */
    public array $accept = self::DEFAULT_ACCEPTS,
    /** List of Archive Formats that the server can unpack. If the server sends a package using a different format, the server MAY treat it as a Binary File */
    public array $acceptArchiveFormat = self::DEFAULT_ACCEPT_ARCHIVE_FORMAT,
    /** List of Packaging Formats which are acceptable to the server. */
    public array $acceptPackaging = self::DEFAULT_ACCEPT_PACKAGING,
    /** List of Metadata Formats which are acceptable to the server. */
    public array $acceptMetadata = self::DEFAULT_ACCEPT_METADATA,

    /** URL and description of the server’s collection policy. */
    public ?CollectionPolicy $collectionPolicy = null,
    /** URL and description of the treatment content can expect during deposit. */
    public ?Treatment $treatment = null,

    /** The URL where clients may stage content prior to deposit, in particular for segmented upload */
    public ?string $staging = null,
    /** What is the minimum time a server will hold on to an incomplete Segmented File Upload since it last received any content before deleting it. */
    public ?int $stagingMaxIdle = self::DEFAULT_STAGING_MAX_IDLE,

    /** Does the server support By-Reference deposit? */
    public bool $byReferenceDeposit = false,
    /** Does the server support deposit on behalf of other users (mediation) */
    public bool $onBehalfOf = false,

    /** The list of digest formats that the server will accept. */
    public array $digest = self::DEFAULT_DIGEST,
    /** List of authentication schemes supported by the server. */
    public array $authentication = self::DEFAULT_AUTHENTICATION,

    /** List of Services contained within the parent service */
    protected array $services = [],
  ) {
  }

  /**
   * Add a service to the end of the list of services offered by this service.
   */
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
