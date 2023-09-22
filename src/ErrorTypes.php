<?php

namespace Asmecher\Swordv3Server;

/**
 * An enumeration of the SWORD v3 Error Types.
 *
 * This class is used in building the Error Document. See [12. Error Types](https://swordapp.github.io/swordv3/swordv3.html#12) in the SWORD 3.0 Specification for details.
 *
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
enum ErrorTypes: string
{
  /** The request supplied invalid credentials */
  case AUTHENTICATION_FAILED = 'AuthenticationFailed';
  /** The request supplied no credentials, when the server was expecting to authenticate the request. */
  case AUTHENTICATION_REQUIRED = 'AuthenticationRequired';
  /** The request did not meet the standard specified by the SWORD protocol. This error can be used when no other error is appropriate */
  case BAD_REQUEST = 'BadRequest';
  /** The client supplied a By-Reference deposit file, which specified a file size which exceeded the server's limit */
  case BY_REFERENCE_FILE_SIZE_EXCEEDED = 'ByReferenceFileSizeExceeded';
  /** The client attempted to carry out a By-Reference deposit on a server which does not support it */
  case BY_REFERENCE_NOT_ALLOWED = 'ByReferenceNotAllowed';
  /** The body content of the request was malformed in some way, such that the server cannot read it correctly. */
  case CONTENT_MALFORMED = 'ContentMalformed';
  /** The `Content-Type` header specifies a content type of the request which is in a format that the server cannot accept. */
  case CONTENT_TYPE_NOT_ACCEPTABLE = 'ContentTypeNotAcceptable';
  /** One or more of the Digests that the server checked did not match the deposited content */
  case DIGEST_MISMATCH = 'DigestMismatch';
  /** The client supplied an `If-Match` header which did not match the current `ETag` for the resource being updated. */
  case ETAG_NOT_MATCHED = 'ETagNotMatched';
  /** The client did not supply an `If-Match` header, when one was required by the server */
  case ETAG_REQUIRED = 'ETagRequired';
  /** The client requested an operation that is not permitted by the server in this context. */
  case FORBIDDEN = 'Forbidden';
  /** The `Metadata-Format` or `Packaging` header does not match what the server found when looking at the Metadata or Packaged Content supplied in a request. */
  case FORMAT_HEADER_MISMATCH = 'FormatHeaderMismatch';
  /** The client sent a segment that was not the final segment, and was not the size that it indicated segments would be, or during segmented upload initialisation, the client specified a segment size which was not between `minSegmentSize` and `maxSegmentSize`. */
  case INVALID_SEGMENT_SIZE = 'InvalidSegmentSize';
  /** During a segmented upload initialisation, the client specified a total file size which is larger than the maximum assembled file size supported by the server */
  case MAX_ASSEMBLED_SIZE_EXCEEDED = 'MaxAssembledSizeExceeded';
  /** The request supplied body content which is larger than that supported by the server. */
  case MAX_UPLOADED_SIZE_EXCEEDED = 'MaxUploadSizeExceeded';
  /** The `Metadata-Format` header specifies a metadata format for the request which is in a format that the server cannot accept */
  case METADATA_FORMAT_NOT_ACCEPTABLE = 'MetadataFormatNotAcceptable';
  /** The request is for a method on a resource that is not permitted. This may be permanent, temporary, and may depend on the client’s credentials */
  case METHOD_NOT_ALLOWED = 'MethodNotAllowed';
  /** The request contained an `On-Behalf-Of` header, although the server indicates that it does not support this. */
  case ON_BEHALF_OF_NOT_ALLOWED = 'OnBehalfOfNotAllowed';
  /** The `Packaging` header specifies a packaging format for the request which is in a format that the server cannot accept */
  case PACKAGING_FORMAT_NOT_ACCEPTABLE = 'PackagingFormatNotAcceptable';
  /** The client's segmented upload URL has timed out. Servers MAY respond to this with a 404 and no explanation also. */
  case SEGMENTED_UPLOAD_TIMEOUT = 'SegmentedUploadTimedOut';
  /** During a segmented upload initialisation, the client specified a total number of intended segments which is larger than the limit specified by the server */
  case SEGMENT_LIMIT_EXCEEDED = 'SegmentLimitExceeded';
  /** The client sent a segment that the server was not expecting; in particular the server may have recieved all the segments it was expecting, and this is an extra one */
  case UNEXPECTED_SEGMENT = 'UnexpectedSegment';

  /**
   * Get the HTTP response status code associated with a SWORD error type.
   */
  public function getErrorCode(): int
  {
    return match($this) {
      self::AUTHENTICATION_FAILED => 403,
      self::AUTHENTICATION_REQUIRED => 401,
      self::BAD_REQUEST => 400,
      self::BY_REFERENCE_FILE_SIZE_EXCEEDED => 400,
      self::BY_REFERENCE_NOT_ALLOWED => 412,
      self::CONTENT_MALFORMED => 400,
      self::CONTENT_TYPE_NOT_ACCEPTABLE => 415,
      self::DIGEST_MISMATCH => 412,
      self::ETAG_NOT_MATCHED => 412,
      self::ETAG_REQUIRED => 412,
      self::FORBIDDEN => 403,
      self::FORMAT_HEADER_MISMATCH => 415,
      self::INVALID_SEGMENT_SIZE => 400,
      self::MAX_ASSEMBLED_SIZE_EXCEEDED => 400,
      self::MAX_UPLOADED_SIZE_EXCEEDED => 413,
      self::METADATA_FORMAT_NOT_ACCEPTABLE => 415,
      self::METHOD_NOT_ALLOWED => 405,
      self::ON_BEHALF_OF_NOT_ALLOWED => 412,
      self::PACKAGING_FORMAT_NOT_ACCEPTABLE => 415,
      self::SEGMENTED_UPLOAD_TIMEOUT => 410,
      self::SEGMENT_LIMIT_EXCEEDED => 400,
      self::UNEXPECTED_SEGMENT => 400,
    };
  }

  /**
   * Get the HTTP response status code name associated with a SWORD error type.
   */
  public function getHTTPName(): string
  {
    return match($this) {
      self::AUTHENTICATION_FAILED => 'Forbidden',
      self::AUTHENTICATION_REQUIRED => 'Unauthorized',
      self::BAD_REQUEST => 'BadRequest',
      self::BY_REFERENCE_FILE_SIZE_EXCEEDED => 'BadRequest',
      self::BY_REFERENCE_NOT_ALLOWED => 'PreconditionFailed',
      self::CONTENT_MALFORMED => 'BadRequest',
      self::CONTENT_TYPE_NOT_ACCEPTABLE => 'UnsupportedMediaType',
      self::DIGEST_MISMATCH => 'PreconditionFailed',
      self::ETAG_NOT_MATCHED => 'PreconditionFailed',
      self::ETAG_REQUIRED => 'PreconditionFailed',
      self::FORBIDDEN => 'Forbidden',
      self::FORMAT_HEADER_MISMATCH => 'UnsupportedMediaType',
      self::INVALID_SEGMENT_SIZE => 'BadRequest',
      self::MAX_ASSEMBLED_SIZE_EXCEEDED => 'BadRequest',
      self::MAX_UPLOADED_SIZE_EXCEEDED => 'PayloadTooLarge',
      self::METADATA_FORMAT_NOT_ACCEPTABLE => 'UnsupportedMediaType',
      self::METHOD_NOT_ALLOWED => 'MethodNotAllowed',
      self::ON_BEHALF_OF_NOT_ALLOWED => 'PreconditionFailed',
      self::PACKAGING_FORMAT_NOT_ACCEPTABLE => 'UnsupportedMediaType',
      self::SEGMENTED_UPLOAD_TIMEOUT => 'MethodNotAllowed',
      self::SEGMENT_LIMIT_EXCEEDED => 'BadRequest',
      self::UNEXPECTED_SEGMENT => 'BadRequest',
    };
  }
}
