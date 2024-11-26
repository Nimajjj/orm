<?php

declare(strict_types=1);

namespace App;
require_once __DIR__ . '/../vendor/autoload.php';

use App\NewsEntityManager;
use App\Factory\NewsFactory;
use App\VO\UID;


$factory = new NewsFactory();
$news = $factory->createNews(
    new UID("1596c72050f2a63000f917dbc7ed63f8"),
    "Super-man", 
    new \DateTimeImmutable('now')
);

$manager = new NewsEntityManager();
$manager->update($news);