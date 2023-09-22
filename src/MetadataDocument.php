<?php

namespace Asmecher\Swordv3Server;

/**
 * A representation of a SWORD v3 Metadata Document.
 *
 * Buld this class as follows:
 * ```php
 * $metadataDocument = new MetadataDocument(
 *   id: 'http://example.com/object/1/metadata',
 *   metadata: [
 *     'dc:title' => 'The title',
 *     'dcterms:abstract' => 'This is my abstract',
 *     'dc:contributor' => 'A.N. Other',
 *   ]
 * );
 * ```
 * ...or...
 * ```php
 * $metadataDocument = new MetadataDocument('http://example.com/object/1/metadata')
 *   ->addMetadata('dc:title', 'The title')
 *   ->addMetadata('dcterms:abstract', 'This is my abstract')
 *   ->addMetadata('dc:contributor', 'A.N. Other');
 * ```
 * Convert the object to JSON using `json_serialize`.
 *
 * See [9.3. Metadata Document](https://swordapp.github.io/swordv3/swordv3.html#9.3) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class MetadataDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'Metadata';

  public function __construct(
    /** The URL of the Metadata Document you are looking at */
    public string $id,
    /** An associative list of metadata element names and values */
    protected array $metadata = [],
  ) {
  }

  /**
   * Add a metadata element to the set.
   * @param string $name The name of the metadata element, e.g. `dc:title`
   */
  public function addMetadata(string $name, string $value): self
  {
    $this->metadata[$name] = $value;
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
