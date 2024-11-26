<?php

namespace App\Model;
use App\VO\UID\UID;

final class News
{
    private ?UID $id;
    private string $content;
    private \DateTimeImmutable $created_at;

    public function getId(): UID
    {
        return $this->id;
    }

    public function setId(?UID $id): News
    {
        $this->id = $id;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): News
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): News
    {
        $this->created_at = $created_at;
        return $this;
    }


}