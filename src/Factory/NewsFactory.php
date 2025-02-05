<?php

namespace App\Factory;
use App\VO\Uid;
use App\Model\News;

// could be static :S

final class NewsFactory
{
    public function createNews(
        ?Uid               $uid,
        string             $content,
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