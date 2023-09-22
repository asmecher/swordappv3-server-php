<?php

namespace Asmecher\Swordv3Server;

use DateTimeImmutable;
use DateTimeInterface;

/**
 * An error document is returned at any point that a synchronous operation fails.
 *
 * Construct this class using named parameters:
 * ```php
 * $errorDocument = new ErrorDocument(
 *   type: ErrorTypes::BAD_REQUEST,
 *   error: 'error summary',
 *   log: text log of any debug information for the client',
 *   timestamp: new DateTimeImmutable()
 * );
 * ```
 * Convert the object to JSON using `json_serialize`.
 *
 * See [9.8. Error Document](https://swordapp.github.io/swordv3/swordv3.html#9.8) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class ErrorDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';

  public function __construct(
    /** JSON-LD identifier for the document type */
    public ErrorTypes $type,
    /** A short summary/title for the error */
    public string $error,
    /** Some detail as to the error, with any information that might help resolve it. */
    public string $log,
    /** When the error occurred. */
    public DateTimeImmutable $timestamp,
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
