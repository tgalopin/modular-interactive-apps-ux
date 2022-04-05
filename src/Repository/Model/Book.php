<?php

namespace App\Repository\Model;

class Book
{
    private string $id;
    private string $title;
    private string $slug;
    private string $image;
    private string $thumbnail;
    private string $description;

    public function __construct(string $id, string $title, string $slug, string $image, string $thumbnail, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->slug = $slug;
        $this->image = $image;
        $this->thumbnail = $thumbnail;
        $this->description = $description;
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
