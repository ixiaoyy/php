<?php


namespace core\database\connection;

// 继承基础类
class MysqlConnection extends Connection
{

    protected static $connection;

    public function getConnection()
    {
        return self::$connection;
    }

    // 执行sql
    public function select($sql, $bindings = [], $useReadPdo = true)
    {
        $statement = $this->pdo;
        $sth = $statement->prepare($sql);
        try {
            $sth->execute( $bindings);
            return  $sth->fetchAll();
        } catch (\PDOException $exception){
            echo ($exception->getMessage());
        }

    }
}
