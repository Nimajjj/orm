<?php

declare(strict_types=1);

namespace App;
require_once __DIR__ . '/../vendor/autoload.php';

use App\Factory\NewsFactory;
use App\VO\UID;
use App\Adapter\MySQLAdapter;
use App\Query\QueryBuilder;
use App\Repository\NewsRepository;


$adapter = new MySQLAdapter();
$queryBuilder = new QueryBuilder();
$repository = new NewsRepository($adapter, $queryBuilder);


$factory = new NewsFactory();
$news = $factory->createNews(
    new UID("1596c72050f2a63000f917dbc7ed63f8"),
    "Super-man",
    new \DateTimeImmutable('now')
);


$newsId = "1596c72050f2a63000f917dbc7ed63f8";

echo "- getById \n";
try {
    $news = $repository->getById($newsId);
    echo "News trouvé avec : " . $newsId. "\n";
    echo "id: " . $news->getId()->getValue(). "\n";
    echo "content: " . $news->getContent() . "\n";
    echo "create: " . $news->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
} catch (\Exception $e) {
    echo "Erreur avec getById : " . $e->getMessage() . "\n";
}

echo "\n - findById \n";
try {
    $news = $repository->findById($newsId);
} catch (\DateMalformedStringException $e) {

}
if ($news) {
    echo "News trouvé avec : "  . $newsId. "\n";
    echo "id: " . $news->getId()->getValue() . "\n";
    echo "content: " . $news->getContent() . "\n";
    echo "create: " . $news->getCreatedAt()->format('Y-m-d H:i:s') . "\n";
} else {
    echo "Aucune news trouvée avec findById.\n";
}

