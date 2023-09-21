<?php

namespace Asmecher\Swordv3Server;

class CollectionPolicy implements \JsonSerializable {
  public string $id;
  public string $description;

  public function jsonSerialize() {
    return [
      '@id' => $this->id,
      'description' => $this->description,
    ];
  }
}
