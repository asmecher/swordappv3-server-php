<?php

namespace Asmecher\Swordv3Server;

use DateTimeImmutable;
use DateTimeInterface;

/**
 * Link object referring to the various files, both content and metadata, available on the object.
 *
 * Construct this class using named parameters:
 * ```php
 * $statusDocument->addLink(new Link(
 *   id: 'http://www.myorg.ac.uk/col1/mydeposit.html',
 *   contentType: 'text/html',
 *   eTag: '...',
 *   status: 'http://purl.org/net/sword/3.0/state/accepted'
 * ));
 * ```
 *
 * This class is used in building the Status Document. See [9.6. Status Document](https://swordapp.github.io/swordv3/swordv3.html#9.6) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class Link implements \JsonSerializable {

  public function __construct(

    /** The URL of the resource */
    public string $id,
    /** Content type of the resource */
    public string $contentType,
    /** The eTag of the resource */
    public string $eTag,
    /** The status of the resource, with regard to ingest. */
    public string $status,
    /** The external URL of the location a By-Reference deposit was retrieved from */
    public ?string $byReference = null,
    /** URL to a newer version of the file in the same Object, if this is present as a resource */
    public ?string $isReplacedBy = null,
    /** URL to a non-sword access point to the file */
    public ?string $relation = null,
    /** URL to an older version of the file in the same Object, if this is also present as a resource. */
    public ?string $replaces = null,
    /** Identifier for the user that deposited the item */
    public ?string $depositedBy = null,
    /** Timestamp of when the deposit happened */
    public ?DateTimeImmutable $depositedOn = null,
    /** Identifier for the user that the item was deposited on behalf of. */
    public ?string $depositedOnBehalfOf = null,
    /** Reference to URL of resource from which the current resource was derived, for example, if extracted from a package that was deposited. */
    public ?string $derivedFrom = null,
    /** Any information associated with the deposit that the client should know. */
    public ?string $log = null,
    /** The package format identifier if the resource is a package. */
    public ?string $packaging = null,
    /** The relationship between the resource and the object. */
    public array $rel = [],
    /** Date that the current resource was replaced by a newer resource */
    public ?DateTimeImmutable $versionReplacedOn = null,
  ) {
  }

  public function jsonSerialize() {
    return array_filter([
      '@id' => $this->id,
      'byReference' => $this->byReference,
      'contentType' => $this->contentType,
      'dcterms:isReplacedBy' => $this->isReplacedBy,
      'dcterms:relation' => $this->relation,
      'dcterms:replaces' => $this->replaces,
      'depositedBy' => $this->depositedBy,
      'depositedOn' => $this->depositedOn?->format(DateTimeInterface::ISO8601),
      'depositedOnBehalfOf' => $this->depositedOnBehalfOf,
      'derivedFrom' => $this->derivedFrom,
      'eTag' => $this->eTag,
      'log' => $this->log,
      'packaging' => $this->packaging,
      'rel' => $this->rel,
      'status' => $this->status,
      'versionReplacedOn' => $this->versionReplacedOn?->format(DateTimeInterface::ISO8601),
    ], fn($e) => $e !== null);
  }
}
