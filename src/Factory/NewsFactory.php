<?php

namespace App\Factory;
use App\VO\UID;
use App\Model\News;

final class NewsFactory
{
    public function createNews(
        ?UID $uid,
        string $content,
        \DateTimeImmutable $createAt
    ): News
    {
        $news = new News();
        $news->setId($uid);
        $news->setContent($content);
        $news->setCreatedAt($createAt);

        return $news;
    }
}