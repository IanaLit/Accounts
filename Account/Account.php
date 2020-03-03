<?php

//Модель для работы с таблицей accounts

namespace Account;
use Account\Services\Db;
use Account\Exceptions\InvalidArgumentException;

class Account
{
    /** @var int */
    private $id;
     /** @var string */
    private $first_name;

    /** @var string */
    private $last_name;

    /** @var string */
    private $email;

    /** @var string */
    private $company_name;

    /** @var string */
    private $position;
      /** @var string */
    private $work_phone;

    /** @var string */
    private $home_phone;

    /** @var string */
    private $mobile_phone;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }
    /**
     * @return string
     */
    public function getLastName() 
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getEmail() 
    {
        return $this->email;
    }
    /**
     * @return string
     */
    public function getCompanyName() 
    {
        return $this->company_name;
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }
     public function getWorkPhone()
    {
        return $this->work_phone;
    }
    /**
     * @return string
     */
    public function getHomePhone()
    {
        return $this->home_phone;
    }

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->mobile_phone;
    }

    /**
     * Получение всех записей
     * @param int $start
     * @param int $perpage
     * @return  Account[]
     */

    public static function findAll(int $start, int $perpage): array
    {

        $db = Db::getConnection();
        return  $db->queryAll('SELECT * FROM `accounts` LIMIT :start, :perpage;', 
        	[':start' => $start,
             ':perpage' => $perpage],
             static::class);
    }

    /**
     * Получение количества записей
     * @return int
     */

    public static function count()
    {
        $db = Db::getConnection();
        $result= $db->getCount(
        	'SELECT COUNT(*) FROM `accounts`;'
        );
        return (int)$result;
    }

    /**
     * Получение одной записи
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = Db::getConnection();
        $accounts = $db->query(
            'SELECT * FROM `accounts` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $accounts ? $accounts[0] : null;
    }

    /**
     * Получение имен свойств объекта с помощью рефлексии
     * @return array
     */

    private function mapPropertiesToDbFormat(): array
    {
    	$reflector = new \ReflectionObject($this);
    	$properties = $reflector->getProperties();
		$mappedProperties = [];
    	foreach ($properties as $property) 
    	{
        	$propertyName = $property->getName();
        	$mappedProperties[$propertyName] = $this->$propertyName;
   		 }
		return $mappedProperties;
    }

    /**
     * Сохранение записи
     * @return void
     */

    public function save(): void
    {
    	$mappedProperties = $this->mapPropertiesToDbFormat();
    	if ($this->id !== null) 
    	{
        	$this->update($mappedProperties);
    	} 
    	else 
    	{
        	$this->insert($mappedProperties);
    	}
    }

    /**
     * Обновление записи
     * @return void
     */

	private function update(array $mappedProperties): void
    {
    	$columns2params = [];
    	$params2values = [];
    	$index = 1;
    	foreach ($mappedProperties as $column => $value) 
    	{
        	$param = ':param' . $index; // :param1
        	$columns2params[] = $column . ' = ' . $param; // column1 = :param1
        	$params2values[':param' . $index] = $value; // [:param1 => value1]
        	$index++;
    	}
    	$sql = 'UPDATE  `accounts`  
    	        SET ' . implode(', ', $columns2params) .  
    			' WHERE id = ' . $this->id;
    	$db = Db::getConnection();
    	$db->query($sql, $params2values, static::class);
    }

    /**
     * Вставка записи
     * @return void
     */

	private function insert(array $mappedProperties): void
	{
    	$filteredProperties = array_filter($mappedProperties);
		$columns = [];
    	$paramsNames = [];
    	$params2values = [];
    	foreach ($filteredProperties as $columnName => $value) 
    	{
        	$columns[] = '`' . $columnName. '`';
        	$paramName = ':' . $columnName;
        	$paramsNames[] = $paramName;
        	$params2values[$paramName] = $value;
        }
		$columnsViaSemicolon = implode(', ', $columns);
    	$paramsNamesViaSemicolon = implode(', ', $paramsNames);
		$sql = 'INSERT INTO `accounts`  (' . $columnsViaSemicolon . ') 
			    VALUES (' . $paramsNamesViaSemicolon . ');';
		$db = Db::getConnection();
    	$db->query($sql, $params2values, static::class);
    	$this->id = $db->getLastInsertId();
	}

    /**
     * Удаление записи
     * @return void
     */
	
	public function delete(): void
	{
    	$db = Db::getConnection();
    	$db->query(
        	'DELETE FROM `accounts` WHERE id = :id',
        	 [':id' => $this->id]
    	);
    	$this->id = null;
	}

    /**
     * Создание аккаунта
     * @param array @fields
     * @return Account
     */

	public static function createFromArray(array $fields): Account
	{
    	
    	if (empty($fields['first_name'])) 
    	{
        	throw new InvalidArgumentException('Не передано имя');
    	}
		if (empty($fields['last_name'])) 
		{
        	throw new InvalidArgumentException('Не передана фамилия');
    	}
		if (empty($fields['email'])) 
		{
        	throw new InvalidArgumentException('Не передан email');
    	}
    	if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) 
    	{
        	throw new InvalidArgumentException('Email некорректен');
    	}

	    $account = new Account();
	    $account->first_name = $fields['first_name'];
	    $account->last_name = $fields['last_name'];
	    $account->email = $fields['email'];
	    $account->company_name = $fields['company_name'];
	    $account->position = $fields['position'];
	    $account->work_phone = $fields['work_phone'];
	    $account->home_phone = $fields['home_phone'];
	    $account->mobile_phone = $fields['mobile_phone'];

	    $account->save();

	    return $account;

	}

    /**
     * Изменение аккаунта
     * @param array @fields
     * @return Account
     */

	public function updateFromArray(array $fields): Account
	{
    
    	if (empty($fields['first_name'])) 
    	{
        	throw new InvalidArgumentException('Не передано имя');
    	}
    	if (empty($fields['last_name']))
    	{
        	throw new InvalidArgumentException('Не передана фамилия');
        }
		if (empty($fields['email'])) 
		{
        	throw new InvalidArgumentException('Не передан email');
    	}
    	if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) 
    	{
        throw new InvalidArgumentException('Email некорректен');
    	}

	    $this->first_name = $fields['first_name'];
	    $this->last_name = $fields['last_name'];
	    $this->email = $fields['email'];
	    $this->company_name = $fields['company_name'];
	    $this->position = $fields['position'];
	    $this->work_phone = $fields['work_phone'];
	    $this->home_phone = $fields['home_phone'];
	    $this->mobile_phone = $fields['mobile_phone'];

	    $this->save();

	    return $this;
}
}
	



