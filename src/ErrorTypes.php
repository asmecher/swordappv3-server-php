<?php

namespace Asmecher\Swordv3Server;

/**
 * An enumeration of the SWORD v3 Error Types.
 *
 * This class is used in building the Error Document. See [12. Error Types](https://swordapp.github.io/swordv3/swordv3.html#12) in the SWORD 3.0 Specification for details.
 *
 * @package Swordv3Server
 * @author Alec Smecher <asmecher@sfu.ca>
 * @license https://opensource.org/license/gpl-3-0 GNU General Public License version 3
 */
enum ErrorTypes: string
{
  case AUTHENTICATION_FAILED = 'AuthenticationFailed';
  case AUTHENTICATION_REQUIRED = 'AuthenticationRequired';
  case BAD_REQUEST = 'BadRequest';
  case BY_REFERENCE_FILE_SIZE_EXCEEDED = 'ByReferenceFileSizeExceeded';
  case BY_REFERENCE_NOT_ALLOWED = 'ByReferenceNotAllowed';
  case CONTENT_MALFORMED = 'ContentMalformed';
  case CONTENT_TYPE_NOT_ACCEPTABLE = 'ContentTypeNotAcceptable';
  case DIGEST_MISMATCH = 'DigestMismatch';
  case ETAG_NOT_MATCHED = 'ETagNotMatched';
  case ETAG_REQUIRED = 'ETagRequired';
  case FORBIDDEN = 'Forbidden';
  case FORMAT_HEADER_MISMATCH = 'FormatHeaderMismatch';
  case INVALID_SEGMENT_SIZE = 'InvalidSegmentSize';
  case MAX_ASSEMBLED_SIZE_EXCEEDED = 'MaxAssembledSizeExceeded';
  case MAX_UPLOADED_SIZE_EXCEEDED = 'MaxUploadSizeExceeded';
  case METADATA_FORMAT_NOT_ACCEPTABLE = 'MetadataFormatNotAcceptable';
  case METHOD_NOT_ALLOWED = 'MethodNotAllowed';
  case ON_BEHALF_OF_NOT_ALLOWED = 'OnBehalfOfNotAllowed';
  case PACKAGING_FORMAT_NOT_ACCEPTABLE = 'PackagingFormatNotAcceptable';
  case SEGMENTED_UPLOAD_TIMEOUT = 'SegmentedUploadTimedOut';
  case SEGMENT_LIMIT_EXCEEDED = 'SegmentLimitExceeded';
  case UNEXPECTED_SEGMENT = 'UnexpectedSegment';

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
