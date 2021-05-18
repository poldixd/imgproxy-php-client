<?php

namespace poldixd\ImgProxy;

use Illuminate\Support\Str;

class Image
{
    protected ?int $blur = null;
    protected ?int $width = null;
    protected ?int $height = null;
    protected ?array $gravity = null;
    protected ?string $resizing_type = null;
    protected ?int $quality = null;
    protected bool $enlarge = false;
    protected string $url;
    protected string $extension = 'jpg';

    public function setWidth(?int $width = null)
    {
        if ($width !== null) {
            $this->width = abs($width) ?: 1;
        }

        return $this;
    }

    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setHeight(?int $height = null)
    {
        if ($height !== null) {
            $this->height = abs($height) ?: 1;
        }

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setEnlarge(bool $enlarge)
    {
        $this->enlarge = $enlarge;

        return $this;
    }

    public function setGravity(string $gravity, int $x_offset = 0, int $y_offset = 0)
    {
        $gravity = Str::lower($gravity);

        $allowedGravityValues = [
            'no', // north (top edge);
            'so', // south (bottom edge);
            'ea', // east (right edge);
            'we', // west (left edge);
            'noea', // north-east (top-right corner);
            'nowe', // north-west (top-left corner);
            'soea', // south-east (bottom-right corner);
            'sowe', // south-west (bottom-left corner);
            'ce', // center.
        ];

        if (in_array($gravity, $allowedGravityValues)) {
            $this->gravity = [
                'type' => $gravity,
                'x_offset' => abs($x_offset) ?: 0,
                'y_offset' => abs($y_offset) ?: 0,
            ];
        }

        return $this;
    }

    public function getGravity(): ?array
    {
        return $this->gravity;
    }

    public function setResizingType(string $resizing_type)
    {
        $resizing_type = Str::lower($resizing_type);

        $allowedResizingTypesValues = [
            'fit', //resizes the image while keeping aspect ratio to fit given size;
            'fill', //resizes the image while keeping aspect ratio to fill given size and cropping projecting parts;
            'auto', //if both source and resulting dimensions have the same orientation (portrait or landscape), imgproxy will use fill. Otherwise, it will use fit.
        ];

        if (in_array($resizing_type, $allowedResizingTypesValues)) {
            $this->resizing_type = $resizing_type;
        }

        return $this;
    }

    public function getResizingType(): ?string
    {
        return $this->resizing_type;
    }


    public function setBlur(int $blur = 1)
    {
        $blur = abs($blur) ?: 1;

        if ($blur > 100) {
            $blur = 100;
        }

        $this->blur = $blur;

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

    public function setQuality(int $quality = 90)
    {
        $quality = abs($quality) ?: 90;

        if ($quality > 100) {
            $quality = 100;
        }

        $this->quality = $quality;

        return $this;
    }

    public function getQuality(): ?int
    {
        return $this->quality;
    }
}