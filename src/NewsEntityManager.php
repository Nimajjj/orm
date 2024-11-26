<?php

namespace App\NewsEntityManager;
use App\VO\UID;
use App\Model\News;
use App\Adapter\MySQLAdapter;
use App\Query\QueryBuilder;
use App\Query\QueryAction;
use App\Query\QueryCondition;


final class NewsEntityManager
{
    public function getByID(UID $id): ?News
    {

    }

    public function create(News $news): News
    {
        $query = (new QueryBuilder())
            ->buildAction(QueryAction::INSERT)
            ->buildTable("News")
            ->buildColumns(["id", "content", "created_at"])
            ->buildValues([$news->getId(), $news->getContent(), $news->getCreatedAt()])
            ->build();
        
        var_dump($query);
        var_dump($query->toRawSql());
        
        $adapter = new MySQLAdapter(); // TODO : pass adapter in porivate attribute
    
        $result = $adapter->executeQuery($query);
        var_dump($result);

        // TODO : verify result

        return $news;
    }

    public function update(News $news): News
    {

    }

    public function delete(News $news): void
    {

    }
}