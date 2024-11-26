<?php

declare(strict_types=1);

namespace App;
require_once __DIR__ . '/../vendor/autoload.php';

use App\NewsEntityManager\NewsEntityManager;
use App\Factory\NewsFactory;


$manager = new NewsEntityManager();

$news = (new NewsFactory())
    ->createNews(
        null,
        "Hello World", 
        "12-11-2024"
);

$manager->create($news);