<?php

namespace Asmecher\Swordv3Server;

/**
 * An encapsulation of a collection policy.
 *
 * Construct this class using named parameters:
 * ```php
 * $collectionPolicy = new CollectionPolicy(
 *   id: 'my collection policy id',
 *   description: 'my collection policy description'
 * );
 * ```
 *
 * This class is used in building the Service Document. See [9.2. Service Document](https://swordapp.github.io/swordv3/swordv3.html#9.2) in the SWORD 3.0 Specification for details.
 *
 * @package Swordv3Server
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class CollectionPolicy implements \JsonSerializable {
  public function __construct(
    public string $id,
    public string $description
  ) {
  }

  public function jsonSerialize() {
    return [
      '@id' => $this->id,
      'description' => $this->description,
    ];
  }
}
