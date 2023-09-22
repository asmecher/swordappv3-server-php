<?php

namespace Asmecher\Swordv3Server;

use DateTimeImmutable;
use DateTimeInterface;

class ErrorDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';

  public function __construct(
    public string $type,
    public string $error,
    public string $log,
    public DateTimeImmutable $timestamp
  ) {
  }

  public function jsonSerialize() {
    return [
      '@context' => self::CONTEXT,
      '@type' => $this->type,
      'error' => $this->error,
      'log' => $this->log,
      'timestamp' => $this->timestamp->format(DateTimeInterface::ISO8601),
    ];
  }
}
