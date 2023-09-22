<?php

namespace Asmecher\Swordv3Server;

class StatusDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'Status';

  public string $id;

  public ?string $eTag = null;

  public string $metadataId;
  public string $metadataEtag;

  public string $fileSetId;
  public string $fileSetEtag;
  public string $service;
  protected array $state;
  public Actions $actions;

  protected array $links = [];

  public function __construct(string $id) {
    $this->id = $id;
  }

  public function addState(string $id, ?string $description): self
  {
    $this->state[] = (object) ['@id' => $id, 'description' => $description];
    return $this;
  }

  public function addLink(Link $link): self
  {
    $this->links[] = $link;
    return $this;
  }

  public function jsonSerialize() {
    return array_filter([
      '@context' => self::CONTEXT,
      '@id' => $this->id,
      '@type' => self::TYPE,
      'eTag' => $this->eTag,
      'metadata' => (object) ['@id' => $this->fileSetId, 'eTag' => $this->fileSetEtag],
      'fileSet' => (object) ['@id' => $this->fileSetId, 'eTag' => $this->fileSetEtag],
      'service' => $this->service,
      'state' => $this->state,
      'actions' => $this->actions,
      'links' => $this->links,
    ], fn($e) => $e !== null);
  }
}
