<?php

namespace Asmecher\Swordv3Server;

class Link implements \JsonSerializable {
  public string $id;
  public ?string $byReference = null;
  public string $contentType;
  public ?string $isReplacedBy = null;
  public ?string $relation = null;
  public ?string $replaces = null;
  public ?string $depositedBy = null;
  public ?string $depositedOn = null;
  public ?string $depositedOnBehalfOf = null;
  public ?string $derivedFrom = null;
  public string $eTag;
  public ?string $log = null;
  public ?string $packaging = null;
  public array $rel = [];
  public string $status;
  public ?string $versionReplacedOn = null;

  public function __construct(string $id) {
    $this->id = $id;
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
      'depositedOn' => $this->depositedOn,
      'depositedOnBehalfOf' => $this->depositedOnBehalfOf,
      'derivedFrom' => $this->derivedFrom,
      'eTag' => $this->eTag,
      'log' => $this->log,
      'packaging' => $this->packaging,
      'rel' => $this->rel,
      'status' => $this->status,
      'versionReplacedOn' => $this->versionReplacedOn,
    ], fn($e) => $e !== null);
  }
}
