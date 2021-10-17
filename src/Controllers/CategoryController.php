<?php

namespace MasterOk\Controllers;

use MasterOk\Interfaces\ControllerBaseDataInterface;

/**
 * Класс для всего, что связано с таблицей category
 */
class CategoryController implements ControllerBaseDataInterface
{
    protected $table = 'category';

    /**
     * Функция добавляет новую категорию, если такой еще не было
     *
     * @return success
     */
    public function add()
    {
        $post = $_POST;
        $db = new DataBaseController;

        $name = $post['name'];
        $sql = "SELECT name FROM $this->table WHERE name = ?";
        $query = $db->pdo->prepare($sql);
        $query->execute([$name]);
        $query = $query->fetchAll();

        if ($query == array()) {
            $db->insert($this->table,['name'],[$name]);
            echo json_encode(['success' => 'success', 'message' => "Вы добавили категорию"]);
        } else {
            echo json_encode(['success' => 'error', 'message' => "Такая категория уже есть"]);
        }
    }

    /**
     * Удаление строки по id
     *
     * @return void
     */
    public function delete()
    {
        $post = $_POST;
        $db = new DataBaseController;

        $id = $post['id'];

        $db->delete($this->table,$id);
    }

    /**
     * Получение всех данных из таблицы
     *
     * @return query
     */
    public function get()
    {
        $db = new DataBaseController;
        $query = $db->select($this->table);
        echo json_encode($query);
    }
}