<?php

//namespace Benjamin\Orm\Repository;
//use App\IAdapter;
//use Benjamin\Orm\Adapter\MySQLAdapter;
//use Benjamin\Orm\Model\News;
//use Benjamin\Orm\Query\QueryAction;
//use Benjamin\Orm\Query\QueryBuilder;
//use Benjamin\Orm\Query\QueryCondition;
//use Benjamin\Orm\Query\QueryLogicalOperator;

class NewsRepository {
    private IAdapter $adapter;
    private QueryBuilder $queryBuilder;

    public function __construct(IAdapter $adapter, QueryBuilder $queryBuilder) {
        $this->adapter = $adapter;
        $this->queryBuilder = $queryBuilder;
    }

    public final function getById(string $id) : News {
        $query = $this->queryBuilder
            ->buildAction(QueryAction::SELECT)
            ->buildTable('News')
            ->buildColumns(['ID', 'Value', 'CreatedAt'])
            ->buildCondition('ID', QueryCondition::IS_EQUAL, $id, null)
            ->build();

        $result = $this->adapter->executeQuery($query);

        return new News($result['ID'], $result['Value'], $result['CreatedAt']);
    }

    public final function findById(String $id) : ?News {
        $query = $this->queryBuilder
            ->buildAction(QueryAction::SELECT)
            ->buildTable('News')
            ->buildColumns(['ID', 'Value', 'CreatedAt'])
            ->buildCondition('ID', QueryCondition::IS_EQUAL, $id, null)
            ->build();

        $result = $this->adapter->executeQuery($query);

        return new News($result['ID'], $result['Value'], $result['CreatedAt']);
    }
}



<?php

namespace Benjamin\Orm\Repository;
use Benjamin\Orm\Adapter\IAdapter;
use Benjamin\Orm\Adapter\MySQLAdapter;
use Benjamin\Orm\Model\News;
use Benjamin\Orm\Query\QueryAction;
use Benjamin\Orm\Query\QueryBuilder;
use Benjamin\Orm\Query\QueryCondition;
use Benjamin\Orm\Query\QueryLogicalOperator;

class NewsRepository {
    private IAdapter $adapter;
    private QueryBuilder $queryBuilder;

    public function __construct(IAdapter $adapter, QueryBuilder $queryBuilder) {
        $this->adapter = $adapter;
        $this->queryBuilder = $queryBuilder;
    }

    public final function getById(string $id) : News {
        $query = $this->queryBuilder
            ->buildAction(QueryAction::SELECT)
            ->buildTable('News')
            ->buildColumns(['ID', 'Value', 'CreatedAt'])
            ->buildCondition('ID', QueryCondition::IS_EQUAL, $id, null)
            ->build();

        $result = $this->adapter->executeQuery($query);

        return new News($result['ID'], $result['Value'], $result['CreatedAt']);
    }

    public final function findById(String $id) : ?News {
        $query = $this->queryBuilder
            ->buildAction(QueryAction::SELECT)
            ->buildTable('News')
            ->buildColumns(['ID', 'Value', 'CreatedAt'])
            ->buildCondition('ID', QueryCondition::IS_EQUAL, $id, null)
            ->build();

        $result = $this->adapter->executeQuery($query);

        return new News($result['ID'], $result['Value'], $result['CreatedAt']);
    }
}



