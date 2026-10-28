<?php

namespace App\Products\Domain\Entities;

class Product
{
    private string $id;
    private string $name;
    private ?string $description;

    private array $variants = [];

    public function __construct(string $id, string $name, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function addVariant(ProductVariant $variant): void
    {
        $this->variants[] = $variant;
    }
    public function getVariants(): array
    {
        return $this->variants;
    }

}