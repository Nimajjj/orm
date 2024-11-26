<?php
namespace App\Adapter;
use App\Adapter\IAdapter;
use App\Query\Query;

final class MySQLAdapter implements IAdapter
{
    private ?\PDO $database = null;

    public function executeQuery(Query $query): array|bool
    {
        $rawQuery = $query->toRawSql();
        $statement = $this->getDatabase()->prepare($rawQuery); 
        assert($statement, "Error while preparing the query : '$rawQuery'");
    
        $statement->execute();
        $result = $statement->fetch();
        assert($result);

        var_dump($result);

        return $result;
    }

    private function getDatabase(): \PDO
    {
        if ($this->database === null) {
            $file = 'credentials.json';
            $data = file_get_contents($file);
            $obj = json_decode($data);

            $this->database = new \PDO("mysql:host=$obj->host; dbname=$obj->dbname; charset=utf8", $obj->username, $obj->password);
        }

        assert($this->database, "Fail to connect to database.");
        return $this->database;
    }
}