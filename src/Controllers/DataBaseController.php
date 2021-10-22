<?php


namespace MasterOk\Controllers;

use PDO;

/**
 * Класс работы с Базой Данных при помощи PDO
 */
class DataBaseController
{
    public $pdo;

    /**
     * Конструктор класса, который создает PDO-объект
     * 
     * @return PDO
     */
    public function __construct()
    {
        $dbInfo = require 'src/Config/DataBaseInfo.php';

        $dsn = $dbInfo['adapter'].':host='.$dbInfo['host'].';dbname='.$dbInfo['dbname'].';charset='.$dbInfo['charset'];
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn,$dbInfo['user'],$dbInfo['password'], $opt);
    }


    /**
     * Функция для выбора данных из бд без условий
     *
     * @param string $table
     * @return array $query as Все строки из таблицы
     */
    public function select (string $table)
    {
        $sql = "SELECT * FROM $table";
        $pdo = $this->pdo;
        $query = $pdo->prepare($sql);
        $query->execute();
        $query = $query->fetchAll();
        return $query;
    }

    /**
     * Функция для вставки в базу данных
     * Парсятся паттерны и данные, после чего объеденяются и выполняется подготовленный запрос,
     * который принимает и паттерны и данные.
     * 
     * @param string $table
     * @param array $column
     * @param array $data
     * @return void
     */
    public function insert (string $table,array $column ,array $data)
    {
        $pattern_array = [];
        $data_end = [];
        $pdo = $this->pdo;
        foreach ($data as $item) {
            if ($item !== null) {
                $item = '?';
                array_push($pattern_array, $item);
            }
        }

        foreach($data as $item) {
            if ($item !== null) {
                array_push($data_end,$item);
            }
        }

        $pattern = implode(",",$pattern_array);
        $column = implode(",",$column);
        $sql = "INSERT INTO $table ($column) values ($pattern)";
        $query = $pdo->prepare($sql);
        $query->execute($data_end);

    }


    /**
     * Функция для обновления данных в какой-то абстрактной таблице.
     * Тот же принцип парсинга как и в вставке.
     *
     * @param string $table
     * @param array $columns
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function update (string $table,array $columns,array $data, int $id)
    {
        $pdo = $this->pdo;
        $pattern_array = [];

        foreach ($data as $item) {
            if ($item !== null) {
                $item = '?';
                array_push($pattern_array, $item);
            }
        }

        array_push($data,['id'=>$id]);

        $pattern = implode(",",$pattern_array);

        $sql = "UPDATE $table SET $pattern WHERE id = :id";

        $query = $pdo->prepare($sql);
        $query->execute($data);
    }

    /**
     * Функция для удаления записи в таблице по id.
     *
     * @param string $table
     * @param integer $id
     * @return void
     */
    public function delete (string $table, int $id)
    {
        $pdo = $this->pdo;
        $sql = "DELETE FROM $table WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }
}