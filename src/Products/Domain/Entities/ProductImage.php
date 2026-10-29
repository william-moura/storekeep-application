<?php

namespace Src\Products\Domain\Entities;

use InvalidArgumentException;

final class ProductImage
{
    public function __construct(
        public readonly string $id,
        private string $url,
        private bool $isCover = false
    ) {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("A URL da imagem informada é inválida.");
        }
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function isCover(): bool
    {
        return $this->isCover;
    }

    public function setAsCover(): void
    {
        $this->isCover = true;
    }

    public function removeCoverStatus(): void
    {
        $this->isCover = false;
    }
}