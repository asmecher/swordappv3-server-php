<?php

namespace Asmecher\Swordv3Server;

/**
 * A representation of a SWORD v3 Status Document.
 *
 * Buld this class as follows:
 * ```php
 * $statusDocument = new StatusDocument(
 *   id: 'http://www.myorg.ac.uk/sword3/object/1',
 *   eTag: '...',
 *   metadataId: 'http://www.myorg.ac.uk/sword3/object/1/metadata',
 *   metadataEtag: '...',
 *   fileSetId: 'http://www.myorg.ac.uk/sword3/object/1fileset',
 *   fileSetEtag: '...',
 *   service: 'http://www.myorg.ac.uk/sword3',
 *   actions: new Actions(...),
 *   ...
 * );
 * $statusDocument->addState('http://purl.org/net/sword/3.0/state/inProgress', 'the item is currently inProgress');
 * ```
 * Convert the object to JSON using `json_serialize`.
 *
 * See [9.6. Status Document](https://swordapp.github.io/swordv3/swordv3.html#9.6) in the SWORD 3.0 Specification for details.
 *
 * @package Swordv3Server
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class StatusDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'Status';

  protected array $state;

  public function __construct(
    public string $id,
    public string $metadataId,
    public string $metadataEtag,
    public string $fileSetId,
    public string $fileSetEtag,
    public string $service,
    public Actions $actions,
    public ?string $eTag = null,
    protected array $links = []
  ) {
  }

  public function addState(string $id, ?string $description): self
  {
    $this->state[] = (object) ['@id' => $id, 'description' => $description];
    return $this;
  }

  public function addLink(Link $link): self
  {
    $this->links[] = $link;
    return $this;
  }

  public function jsonSerialize() {
    return array_filter([
      '@context' => self::CONTEXT,
      '@id' => $this->id,
      '@type' => self::TYPE,
      'eTag' => $this->eTag,
      'metadata' => (object) ['@id' => $this->fileSetId, 'eTag' => $this->fileSetEtag],
      'fileSet' => (object) ['@id' => $this->fileSetId, 'eTag' => $this->fileSetEtag],
      'service' => $this->service,
      'state' => $this->state,
      'actions' => $this->actions,
      'links' => $this->links,
    ], fn($e) => $e !== null);
  }
}
