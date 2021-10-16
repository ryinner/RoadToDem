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
     * Конструктор класса
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

    public function select (string $table, string $where = null)
    {
        $sql = "SELECT * FROM $table";
        $pdo = $this->pdo;
        $query = $pdo->prepare($sql);
        $query->execute();
        $query = $query->fetchAll();
        return $query;
    }

    public function insert (string $table,array $column ,array $data)
    {
        $pattern_array = [];
        $data_end = [];
        $pdo = $this->pdo;
        foreach ($data as $item) {
            if ($item !== null) {
                $item = '":'.$item.'"';
                array_push($pattern_array, $item);
            }
        }

        foreach($data as $item) {
            if ($item !== null) {
                $item = [$item => $item];
                array_push($data_end,$item);
            }
        }

        $pattern = implode(",",$pattern_array);
        $column = implode(",",$column);

        $sql = "INSERT INTO $table ($column) values ($pattern)";
        $query = $pdo->prepare($sql);
        $query->execute($data_end);

    }

    public function update (string $table,array $columns,array $data, int $id)
    {
        $pdo = $this->pdo;
        $pattern_array = [];

        foreach ($data as $item) {
            $item = ':'.$item;
            array_push($pattern_array, $item);
        }

        for ($i=0;$i<count($data);$i++) {
            $pattern_array[$i] = $columns[$i].' = '.$pattern_array[$i] ;
        }

        for($i=0;$i<count($data);$i++) {
            $data = [(string)$data[$i] => $data[$i]];
        }

        array_push($data,['id'=>$id]);

        $pattern = implode(",",$pattern_array);

        $sql = "UPDATE $table SET $pattern WHERE id = :id";

        $query = $pdo->prepare($sql);
        $query->execute($data);
    }

    public function delete (string $table, int $id)
    {
        $pdo = $this->pdo;
        $sql = "DELETE FROM $table WHERE id = :id";
        $query = $pdo->prepare($sql);
        $query->execute(['id' => $id]);
    }
}