<?php

namespace Asmecher\Swordv3Server;

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
