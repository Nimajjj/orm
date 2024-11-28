<?php

declare(strict_types=1);

namespace App;
require_once __DIR__ . '/../vendor/autoload.php';

use App\NewsEntityManager;
use App\Factory\NewsFactory;
use App\VO\UID;


$news = (new NewsFactory())->createNews(
    new UID(),
    "This is a news",
    new \DateTimeImmutable("now")
);

$manager = new NewsEntityManager();

$manager->create($news);
echo $manager->getByID($news->getId()) . "\n";

$news->setContent("This news has been updated.");
$manager->update($news);
echo $manager->getByID($news->getId()) . "\n";

try
{
    $manager->delete($news);
    echo $manager->getByID($news->getId()) . "\n";
}
catch (\Exception $e)
{
    echo "$e\n";
}
