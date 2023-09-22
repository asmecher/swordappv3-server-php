<?php

namespace Asmecher\Swordv3Server;

class MetadataDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'Metadata';

  public function __construct(
    public string $id,
    protected array $metadata = []
  ) {
  }

  public function addMetadata(string $field, string $value): self
  {
    $this->metadata[$field] = $value;
    return $this;
  }

  public function jsonSerialize() {
    return array_merge([
      '@context' => self::CONTEXT,
      '@id' => $this->id,
      '@type' => self::TYPE,
    ], $this->metadata);
  }
}
