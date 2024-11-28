<?php

namespace App;
use App\VO\UID;
use App\Model\News;
use App\Adapter\MySQLAdapter;
use App\Query\QueryBuilder;
use App\Query\QueryAction;
use App\Query\QueryCondition;
use App\Repository\NewsRepository;


final class NewsEntityManager
{
    private MySQLAdapter $adapter;
    private NewsRepository $repository;

    public function __construct()
    {
        $this->adapter = new MySQLAdapter();
        $this->repository = new NewsRepository($this->adapter);
    }

    public function getByID(UID $id): News
    {
        return $this->repository->getById($id);
    }

    public function create(News $news): News
    {
        $query = (new QueryBuilder())
            ->buildAction(QueryAction::INSERT)
            ->buildTable("News")
            ->buildColumns(["id", "content", "created_at"])
            ->buildValues([$news->getId(), $news->getContent(), $news->getCreatedAt()])
            ->build();
        
        $__ = [];
        $error = $this->adapter->executeQuery($query, $__);

        assert(!$error, "Querry failed.");

        return $news;
    }

    public function update(News $news): News
    {
        $query = (new QueryBuilder())
            ->buildAction(QueryAction::UPDATE)
            ->buildTable("News")
            ->buildColumns(["id", "content", "created_at"])
            ->buildValues([$news->getId(), $news->getContent(), $news->getCreatedAt()])
            ->buildCondition("id", QueryCondition::IS_EQUAL, $news->getId()->getValue())
            ->build();

        $__ = [];
        $error = $this->adapter->executeQuery($query, $__);

        assert(!$error, "Querry failed.");

        return $news;
    }

    public function delete(News $news): void
    {
        $query = (new QueryBuilder())
            ->buildAction(QueryAction::DELETE)
            ->buildTable("News")
            ->buildCondition("id", QueryCondition::IS_EQUAL, $news->getId()->getValue())
            ->build();

        $__ = [];
        $error = $this->adapter->executeQuery($query, $__);

        assert(!$error, "Querry failed.");
    }
}