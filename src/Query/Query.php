<?php

namespace App\Query;
use App\Query\QueryAction;

final class Query
{
    public QueryAction $action;
    public array $condition; // [["subject" => string, "condition" => QueryCondition, "value" => string, "operator" => ?QueryLogicalOperator]]
    public string $table;
    public array $columns;
    public array $values;

    public function __construct()
    {
    }

    public function isValid(): bool
    {
        return true;
    }
}