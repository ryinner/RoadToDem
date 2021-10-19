<?php

namespace MasterOk\Controllers;

use MasterOk\Interfaces\ControllerDataInterface;

/**
 * Класс для всего, что связано с таблицей orders
 */
class OrdersController implements ControllerDataInterface
{
    protected $table = 'orders';

    public function get()
    {
        // Новую штуку сразу с учетом разных статусов и тому подобного рисовать через js в цикле, в зависимости от статуса
    }

    /**
     * Функция для добавления новых заявок с всей валидацией.
     * Проверка на расширения и размер файла через внутрение
     * функции, если все хорошо то выполняется абстрактный метод
     * из контроллера баз данных.
     * Пути и дата парсятся.
     * 
     * @return void
     */
    public function add()
    {   
        $login       = $_SESSION['login'];

        $sql = "SELECT id FROM users WHERE login = '$login'";
        $db = new DataBaseController;
        $query = $db->pdo->query($sql);
        $query = $query->fetchALl();
        foreach ($query as $item){
            $id = $item['id'];
        }

        $post        = $_POST;
        $files       = $_FILES;
        $adress      = $post['adress'];
        $description = $post['description'];
        $maxPrice    = $post['maxPrice'];
        $data        = date('d-m-y');
        $category    = $post['category'];
        $tmp         = $files['img']['tmp_name'];
        $img         = $files['img']['name'];
        $imgSize     = $files['img']['size'];
        $imgExtension= pathinfo($img, PATHINFO_EXTENSION);

        $allowedExtension = ['jpg', 'jpeg', 'png', 'bmp'];
        $allowedSize = 2097152;

        if ($imgSize < $allowedSize) {
            if (in_array($imgExtension, $allowedExtension)) {
                $path = 'src/front/img/';
                $rand = rand();
                $imgEndPath = $path.$rand.$img;
                if (move_uploaded_file($tmp, $imgEndPath)) {
                    $db->insert($this->table,['adress', 'description', 'max_price', 'data', 'photo_user', 'category_id', 'user_id'],[$adress,$description,$maxPrice,$data,$imgEndPath,$category,$id]);
                    echo json_encode([
                        'success' => "success",
                        'message' => "Вы добавили заявку"
                    ]);
                } else {
                    echo json_encode([
                        'success' => "error",
                        'message' => "Ошибка загрузки на сервер"
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => "error",
                    'message' => "Не jpg, jpeg, png, bmp"
                ]);
            }
        } else {
            echo json_encode([
                'success' => "error",
                'message' => "Файл-то слишком большой"
            ]);
        }
    }

    public function delete()
    {
        $post = $_POST;
        $db = new DataBaseController;

        $id = $post['id'];

        $db->delete($this->table,$id);
    }

    public function update()
    {
        
    }
}