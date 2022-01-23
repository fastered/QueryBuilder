<?php


class QueryBuilder
{
    protected $pdo;

    function __construct()
    {
        $this->pdo = new PDO('mysql:host=yourhostname;dbname=yordbname;charset=utf8','usernameDB','PASSWORD');

    }

    /**
     * @param string $table - имя таблицы
     * @param array $data - данные в массиве с ключами как наименование  колон таблицы
     * @return integer id - возвращает id записанной строки, или ноль если не записалось
     */
    public function create($table = '', $data = [])
    {
        $keys='';
        foreach ($data as $key => $datum) {
            $keys.= $key.' = :'.$key.', ';
        }
        $keys = rtrim($keys,', ');
        $sql = "INSERT INTO {$table} SET {$keys}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }

    /**
     * @param string $table -  имя таблицы
     * @param array $data  - данные в массиве с ключами как наименование  колон таблицы
     */
    public function update($table = '', $data= [])
    {
        $id = $data['id'];
        unset( $data['id']);
        $keys='';
        foreach ($data as $key => $datum) {
            $keys.= $key.' = :'.$key.', ';
        }
        $data['id'] = $id;
        $keys = rtrim($keys,', ');
        $sql = "UPDATE {$table} SET {$keys} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /**
     * @param string $table - имя таблицы
     * @param integer $id удаляеммой записи
     */
    public function delete($table = '', $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id'=>$id] );

    }

    /**
     * @param string $table - имя таблицы
     * @param int $id - ид запрашиваеммой записи
     * @return mixed - возвращает ассоциативный массив если отработало без ошибок, иначе false
     */
    public function getOne($table = '', $id = 0)
    {
        $sql = "SELECT * FROM {$table} WHERE  id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id'=>$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table имя таблицы
     * @return array  -	Получаем 2-уровневый массив.
     */
    public function getAll($table = '')
    {
        $sql = "SELECT * FROM {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }



}
