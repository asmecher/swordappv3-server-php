<?php

namespace Asmecher\Swordv3Server;

/**
 * Container for the list of actions that are available against the object for the client.
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
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class Actions {
  public function __construct (
    /** Whether the client can issue a request to retrieve the item metadata */
    public bool $getMetadata = false,
    /** Whether the client can issue a request to retrieve any/all files in the item (both Binary Files and Packaged Content) */
    public bool $getFiles = false,
    /** Whether the client can issue a request to append the metadata of the item */
    public bool $appendMetadata = false,
    /** Whether the client can issue a request to append one or more files (individually or via a package) to the item */
    public bool $appendFiles = false,
    /** Whether the client can issue a request to replace the item metadata. */
    public bool $replaceMetadata = false,
    /** Whether the client can issue a request to replace files in an item. This may be a single file or all of the files. */
    public bool $replaceFiles = false,
    /** Whether the client can issue a request to delete all the item metadata. */
    public bool $deleteMetadata = false,
    /** Whether the client can issue a request to delete files in the item. This may be a single file or all files. */
    public bool $deleteFiles = false,
    /** Whether the client can issue a request to delete the entire object. */
    public bool $deleteObject = false,
  )
  {
  }
}
