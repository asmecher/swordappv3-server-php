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
 * $statusDocument->addState(StatusDocument::STATE_IN_PROGRESS, 'the item is currently inProgress');
 * ```
 * Convert the object to JSON using `json_serialize`.
 *
 * See [9.6. Status Document](https://swordapp.github.io/swordv3/swordv3.html#9.6) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
class StatusDocument implements \JsonSerializable {
  const CONTEXT = 'https://swordapp.github.io/swordv3/swordv3.jsonld';
  const TYPE = 'Status';

  const STATE_ACCEPTED = 'http://purl.org/net/sword/3.0/state/accepted';
  const STATE_IN_PROGRESS = 'http://purl.org/net/sword/3.0/state/inProgress';
  const STATE_IN_WORKFLOW = 'http://purl.org/net/sword/3.0/state/inWorkflow';
  const STATE_INGESTED = 'http://purl.org/net/sword/3.0/state/ingested';
  const STATE_REJECTED = 'http://purl.org/net/sword/3.0/state/rejected';
  const STATE_DELETED = 'http://purl.org/net/sword/3.0/state/deleted';

  /** List of states that the item is in on the server. */
  protected array $state;

  public function __construct(
    /** The Object-URL for this document */
    public string $id,
    /** The Metadata-URL for this Object */
    public string $metadataId,
    /** The ETag for the Metadata */
    public string $metadataEtag,
    /** The FileSet-URL for this Object */
    public string $fileSetId,
    /** The Etag for the FileSet */
    public string $fileSetEtag,
    /** The URL for the service to which this item was deposited (the Service-URL) */
    public string $service,
    /** Container for the list of actions that are available against the object for the client. */
    public Actions $actions,
    /** The current ETag for the Object */
    public ?string $eTag = null,
    /** List of link objects referring to the various files, both content and metadata, available on the object */
    protected array $links = [],
  ) {
  }

  /**
   * Add a state to the end of the state list.
   * @param string $id One of the STATE_... constants, or a custom value
   */
  public function addState(string $id, ?string $description): self
  {
    $this->state[] = (object) ['@id' => $id, 'description' => $description];
    return $this;
  }

  /**
   * Add a link to the end of the link list.
   */
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
