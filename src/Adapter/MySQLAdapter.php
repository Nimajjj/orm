<?php
namespace App\Adapter;
use App\Adapter\IAdapter;
use App\Query\Query;
use App\Query\QueryAction;

final class MySQLAdapter implements IAdapter
{
    private ?\PDO $database = null;

    public function executeQuery(Query $query, array &$outResult): bool
    {
        $rawQuery = $query->toRawSql();
        $statement = $this->getDatabase()->prepare($rawQuery);
        assert($statement, "Error while preparing the query: '$rawQuery'");

        $success = $statement->execute();

        if ($query->action === QueryAction::SELECT) 
        {
            $outResult = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $success && !empty($outResult);
        }

        $outResult = [];
        return $success;
    }



    private function getDatabase(): \PDO
    {
        if ($this->database === null) 
        {
            $file = 'credentials.json';
            $data = file_get_contents($file);
            $obj = json_decode($data);

            $this->database = new \PDO("mysql:host=$obj->host; dbname=$obj->dbname; charset=utf8", $obj->username, $obj->password);
        }

        assert($this->database, "Fail to connect to database.");
        return $this->database;
    }
}