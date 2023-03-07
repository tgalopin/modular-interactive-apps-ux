<?php

namespace App\Repository\Model;

class Book
{
    public function __construct(
        private readonly string $id,
        private readonly string $title,
        private readonly string $slug,
        private readonly string $image,
        private readonly string $thumbnail,
        private readonly string $description,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getThumbnail(): string
    {
        return $this->thumbnail;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
