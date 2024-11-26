<?php

namespace App;
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
        
        $adapter = new MySQLAdapter(); // TODO : pass adapter in private attribute
    
        $result = $adapter->executeQuery($query);

        assert(!$result, "Querry failed.");

        return $news;
    }

    public function update(News $news): News
    {

    }

    public function delete(News $news): void
    {

    }
}