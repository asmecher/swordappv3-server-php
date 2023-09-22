<?php

namespace Asmecher\Swordv3Server;

class ErrorDocument implements \JsonSerializable {
  public string $context = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  public string $type;
  public string $error;
  public string $log;
  public string $timestamp;

  public function jsonSerialize() {
    return [
      '@context' => $this->context,
      '@type' => $this->type,
      'error' => $this->error,
      'log' => $this->log,
      'timestamp' => $this->timestamp,
    ];
  }
}
