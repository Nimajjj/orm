<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';


$query = (new queryBuilder())
    ->buildAction(Querry::SELECT)
    ->buildTable("News")
    ->buildColumns(["ID", "Value", "CreatedAt"])
    ->buildCondition("ID", Querry::IS_EQUAL, "123")
    ->build();

$query2 = (new queryBuilder())
    ->buildAction(Querry::INSERT)
    ->buildTable("News")
    ->buildColumns(["ID", "Value", "CreatedAt"])
    ->buildValues([123, "Hello World", "01/23/2024"])
    ->build();
    
$query3 = (new queryBuilder())
    ->buildAction(Querry::DELETE)
    ->buildTable("News")
    ->buildCondition("ID", Querry::IS_EQUAL, "123")
    ->build();
    
$query4 = (new queryBuilder())
    ->buildAction(Querry::UPDATE)
    ->buildTable("News")
    ->buildColumns(["ID", "Value", "CreatedAt"])
    ->buildValues([123, "Hello World", "01/23/2024"])
    ->buildCondition("ID", Querry::IS_EQUAL, "123")
    ->build();

$query5 = (new queryBuilder())
    ->buildAction(Querry::SELECT)
    ->buildTable("News")
    ->buildColumns(["ID", "Value", "CreatedAt"])
    ->buildCondition("ID", Querry::IS_EQUAL, "123")
    ->buildCondition("CreatedAt", Querry::IS_GREATER, "10/12/2020", Querry::AND)
    ->build();