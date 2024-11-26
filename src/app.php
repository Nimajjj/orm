<?php

declare(strict_types=1);

namespace App;
require_once __DIR__ . '/../vendor/autoload.php';

use App\Adapter\MySQLAdapter;
use App\Query\QueryBuilder;
use App\Query\QueryAction;
use App\Query\QueryCondition;


$query = (new QueryBuilder())
    ->buildAction(QueryAction::SELECT)
    ->buildColumns(["ID", "Value", "CreatedAt"])
    ->buildCondition("ID", QueryCondition::IS_EQUAL, "1")
    ->build();

$adapter = new MySQLAdapter();

$result = $adapter->executeQuery($query);
