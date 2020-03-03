<?php

// Класс для работы с базой данных

namespace Account\Services;
class Db
{

    /** объект класса Db*/
    private static $connection;

    /** @var \PDO */
    private $pdo;
    
    private function __construct()
    {
        $dbOptions = (require __DIR__ . '\settings.php')['db'];

        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );

        $this->pdo->exec('SET NAMES UTF8');
    }
    /**
     *Создание объекта для работы с БД
     * @return self
     */

    public static function getConnection(): self 
    {
        if (self::$connection === null) 
        {
            self::$connection = new self();
        }
        return self::$connection;
    }

    /**
     * Метод выполнения запроса для вывода записей на главную страницу с пагинацией  
     * @param string $sql
     * @param array $params
     * @param string $className 
     * @return Account
     */

    public function queryAll(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':start', (int)$params[":start"], \PDO::PARAM_INT);
        $sth->bindValue(':perpage', (int)$params[":perpage"], \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * Метод выполнения запросов в бд
     * @param string $sql
     * @param array $params
     * @param string $className 
     * @return Account
     */

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        if (false === $result) 
        {
            return null;
        }
        
        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * @param string $sql
     * @return string
     */

    public function getCount(string $sql)
    {
        $sth = $this->pdo->query($sql);
        return $sth->fetchColumn();

    }

    /**
     * @return int
     */

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}