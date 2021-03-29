<?php

namespace poldixd\ImgProxy;

use Illuminate\Support\Str;

class ImageSignature
{
    private $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    public function getEncodedUrl(): string
    {
        return rtrim(strtr(base64_encode($this->image->getOriginalPictureUrl()), '+/', '-_'), '=');
    }

    public function getUrl(): string
    {
        $path = $this->getPath();
        $signature = rtrim(strtr(base64_encode(hash_hmac(
            'sha256',
            $this->getBinarySalt() . $path,
            $this->getBinaryKey(),
            true
        )), '+/', '-_'), '=');

        return sprintf("/%s%s", $signature, $path);
    }

    public function getKey(): string
    {
        if (empty($key = config('img-proxy.key'))) {
            throw new Exception;
        }

        if (Str::length($key) < 32) {
            throw new Exception;
        }
        return $key;
    }

    public function getSalt(): string
    {
        if (empty($salt = config('img-proxy.salt'))) {
            throw new Exception;
        }

        if (Str::length($salt) < 32) {
            throw new Exception;
        }
        return $salt;
    }

    public function getBinaryKey(): string
    {
        if (empty($keyBin = pack("H*", $this->getKey()))) {
            throw new Exception('Key expected to be hex-encoded string');
        }

        return $keyBin;
    }

    public function getBinarySalt(): string
    {
        if (empty($saltBin = pack("H*", $this->getSalt()))) {
            throw new Exception('Salt expected to be hex-encoded string');
        }

        return $saltBin;
    }

    public function getPath(): string
    {
        $path = [];

        if ($this->image->getWidth()) {
            $path[] = "w:{$this->image->getWidth()}";
        }

        if ($this->image->getHeight()) {
            $path[] = "h:{$this->image->getHeight()}";
        }

        if ($this->image->getBlur()) {
            $path[] = "bl:{$this->image->getBlur()}";
        }

        if ($this->image->getGravity()) {
            $path[] = "g:" . implode(':', $this->image->getGravity());
        }

        if ($this->image->getResizingType()) {
            $path[] = "rt:{$this->image->getResizingType()}";
        }

        if ($this->image->getQuality()) {
            $path[] = "q:{$this->image->getQuality()}";
        }

        return '/' . implode('/', $path) . "/{$this->getEncodedUrl()}.{$this->image->getExtension()}";
    }
}