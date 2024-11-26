<?php

namespace App\Repository;

use App\Adapter\MySQLAdapter;
use App\Model\News;
use App\Query\QueryAction;
use App\Query\QueryCondition;
use App\Query\QueryBuilder;
use App\VO\UID;
use DateMalformedStringException;

class NewsRepository {
    private MySQLAdapter $adapter;
    private QueryBuilder $queryBuilder;

    public function __construct(MySQLAdapter $adapter, QueryBuilder $queryBuilder) {
        $this->adapter = $adapter;
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @throws DateMalformedStringException
     */
    public final function getById(string $id): News {
        $query = $this->queryBuilder
            ->buildAction(QueryAction::SELECT)
            ->buildTable('News')
            ->buildColumns(['id', 'content', 'created_at'])
            ->buildCondition('id', QueryCondition::IS_EQUAL, $id, null)
            ->build();

        $result = [];
        $success = $this->adapter->executeQuery($query, $result);

        if (!$success || empty($result)) {
            throw new \RuntimeException("No news found for ID: $id");
        }

        $data = $result[0];

        return (new News())
            ->setId(new UID($data['id']))
            ->setContent($data['content'])
            ->setCreatedAt(new \DateTimeImmutable($data['created_at']));

    }


    /**
     * @throws DateMalformedStringException
     */
    public final function findById(string $id): ?News {
        $query = $this->queryBuilder
                ->resetConditions()
                ->buildAction(QueryAction::SELECT)
                ->buildTable('News')
                ->buildColumns(['id', 'content', 'created_at'])
                ->buildCondition('id', QueryCondition::IS_EQUAL, $id, null)
                ->build();


        $result = [];
        $success = $this->adapter->executeQuery($query, $result);

        if (!$success || empty($result)) {
            return null;
        }

        $data = $result[0];

        return (new News())
            ->setId(new UID($data['id']))
            ->setContent($data['content'])
            ->setCreatedAt(new \DateTimeImmutable($data['created_at']));
    }


}





