<?php

namespace Asmecher\Swordv3Server;

/**
 * URL and description of the server's collection policy.
 *
 * Construct this class using named parameters:
 * ```php
 * $serviceDocument->collectionPolicy = new CollectionPolicy(
 *   id: 'my collection policy id',
 *   description: 'my collection policy description'
 * );
 * ```
 *
 * This class is used in building the Service Document. See [9.2. Service Document](https://swordapp.github.io/swordv3/swordv3.html#9.2) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class CollectionPolicy implements \JsonSerializable {
  public function __construct(
    /** Collection Policy URL */
    public string $id,
    /** Collection Policy Description */
    public string $description,
  ) {
  }

  public function jsonSerialize() {
    return [
      '@id' => $this->id,
      'description' => $this->description,
    ];
  }
}
