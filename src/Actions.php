<?php

namespace Asmecher\Swordv3Server;

/**
 * A description of which actions are or are not supported by the SWORD server.
 *
 * Construct this class using named parameters:
 * ```php
 * $actions = new Actions(
 *   getMetadata: true,
 *   appendMetadata: true
 * );
 * ```
 * All capabilities are `false` by default, so it is only necessary to specify the supported capabilities.
 *
 * This class is used in building the Status Document. See [9.6. Status Document](https://swordapp.github.io/swordv3/swordv3.html#9.6) in the SWORD 3.0 Specification for details.
 *
 * @package Swordv3Server
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class Actions {
  public function __construct (
    public bool $getMetadata = false,
    public bool $getFiles = false,
    public bool $appendMetadata = false,
    public bool $appendFiles = false,
    public bool $replaceMetadata = false,
    public bool $replaceFiles = false,
    public bool $deleteMetadata = false,
    public bool $deleteFiles = false,
    public bool $deleteObject = false
  )
  {
  }
}
