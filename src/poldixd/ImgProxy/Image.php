<?php

namespace poldixd\ImgProxy;

class Image
{
    protected ?int $blur = null;
    protected ?int $width = null;
    protected ?int $height = null;
    protected bool $enlarge = false;
    protected string $url;
    protected string $extension = 'jpg';

    public function setWidth(int $width = 1)
    {
        $this->width = abs($width) ?: 1;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setHeight(int $height = 1)
    {
        $this->height = abs($height) ?: 1;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setEnlarge(bool $enlarge)
    {
        $this->enlarge = $enlarge;

        return $this;
    }

    public function setBlur(int $blur = 1)
    {
        $this->blur = abs($blur) ?: 1;

        return $this;
    }

    public function getBlur(): ?int
    {
        return $this->blur;
    }

    public function setExtension(string $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setOriginalPictureUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    public function getOriginalPictureUrl(): string
    {
        return $this->url;
    }
}