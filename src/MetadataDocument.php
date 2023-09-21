<?php

namespace Asmecher\Swordv3Server;

class MetadataDocument implements \JsonSerializable {
  public string $context = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  public string $id;
  public string $type = 'Metadata';

  protected array $metadata = [];

  public function __construct(string $id) {
    $this->id = $id;
  }

  public function addMetadata(string $field, string $value): self
  {
    $this->metadata[$field] = $value;
    return $this;
  }

  public function jsonSerialize() {
    return array_merge([
      '@context' => $this->context,
      '@id' => $this->id,
      '@type' => $this->type,
    ], $this->metadata);
  }
}
