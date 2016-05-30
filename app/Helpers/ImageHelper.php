<?php

namespace App\Helpers;

class ImageHelper {
  public static $type;
  public static $image;

  public static function load($path) {
    $image = getimagesize($path);
    self::$type = $image['mime'];

    if(self::$type == 'image/jpeg') {
      self::$image = imagecreatefromjpeg($path);
    }
    if(self::$type == 'image/png') {
      self::$image = imagecreatefrompng($path);
    }
    if(self::$type == 'image/gif') {
      self::$image = imagecreatefromgif($path);
    }
    return new self;
  }

  public function save($path = '', $quality = 75, $permission = null) {
    if(self::$type == 'image/jpeg') {
      imagejpeg(self::$image, $path, $quality);
    }
    if(self::$type == 'image/png') {
      imagepng(self::$image, $path);
    }
    if(self::$type == 'image/gif') {
      imagegif(self::$image, $path);
    }
    if(!is_null($permission)) {
      chmod($path, $permission);
    }
  }

  public function getWidth() {
    return imagesx(self::$image);
  }

  public function getHeight() {
    return imagesy(self::$image);
  }

  public function resize($width, $height) {
    $image = imagecreatetruecolor($width, $height);
    imagecopyresampled($image, self::$image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
    self::$image = $image;
    return $this;
  }
}
