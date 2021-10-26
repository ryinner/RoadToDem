<?php

namespace MasterOk\Controllers;

use MasterOk\Interfaces\ControllerDataInterface;

/**
 * Класс для всего, что связано с таблицей orders
 */
class OrdersController implements ControllerDataInterface
{
    protected $table = 'orders';

    /**
     * Получение заявок и формирование трех массивов заявок по статусам.
     * Если получает значение юзера, тогда ищет заявки конкретного пользователя.
     * Все заявки отсортированы по значениям
     * 
     * @return sortOrders
     */
    public function get($user = null)
    {
        $newOrders = [];
        $workingOrders = [];
        $readyOrders = [];

        $db = new DataBaseController;
        $sql = "SELECT * FROM $this->table";
        $query = $db->pdo->query($sql);
        $query = $query->fetchAll();

        foreach ($query as $item) {
            switch ($item['status']) {
                case 'Новая':
                    array_push($newOrders,$item);
                    break;
                
                case 'Ремонтируется':
                    array_push($workingOrders,$item);
                    break;

                case 'Отремонтировано';
                    array_push($readyOrders,$item);
                    break;
            }
        }
        echo '<h3>Новые</h3><div class="row">';
        foreach ($newOrders as $item) {
            echo '<div class="order" id="'.$item['id'].'">
            <h3>Дата: '.$item['data'].'</h3>
            <p class="text__center">Адрес: '.$item['adress'].'</p>
            <p class="text__center">Описание: '. $item['description'] .'</p>
            <button value="'.$item['id'].'" id="working">Ремонтируется</option>
            <button value="'.$item['id'].'" id="ready">Отремонтировано</option>
            </div>';
        }  

        echo '</div><hr><h3>Ремонтируются</h3><div class="row">';
        foreach ($workingOrders as $item) {
            echo '<div class="order" id="'.$item['id'].'">
            <h3>Дата: '.$item['data'].'</h3>
            <p class="text__center">Адрес: '.$item['adress'].'</p>
            <p class="text__center">Описание: '. $item['description'] .'</p>
            </div>';
        }

        echo '</div><hr><h3>Отремонтированые</h3><div class="row">';

        foreach ($readyOrders as $item) {
            echo '<div class="order" id="'.$item['id'].'">
            <h3>Дата: '.$item['data'].'</h3>
            <p class="text__center">Адрес: '.$item['adress'].'</p>
            <p class="text__center">Описание: '. $item['description'] .'</p>
            </div>';
        }

        echo '</div>';
    }

    /**
     * Функция для получения заявок пользователя, а также филтра пользователя.
     *
     * @return $ЗаявкиПользователя
     */
    public function getForUser()
    {
        $userController = new UsersController;
        $db = new DataBaseController;
        $id = $userController->getId();

        $db = new DataBaseController;
        if (empty($_POST['filter'])) {
            $sql = "SELECT  o.id, o.adress, o.description, o.max_price, o.data, o.status, o.photo_user, o.photo_admin, o.end_price, c.name FROM $this->table o INNER JOIN category c ON o.category_id = c.id WHERE o.user_id = $id";
        } else {
            $filter = $_POST['filter'];
            $sql = "SELECT  o.id, o.adress, o.description, o.max_price, o.data, o.status, o.photo_user, o.photo_admin, o.end_price, c.name FROM $this->table o INNER JOIN category c ON o.category_id = c.id WHERE o.user_id = $id AND o.status = '$filter'";
        }
        
        $query = $db->pdo->query($sql);
        $query = $query->fetchAll();

        echo json_encode($query);
    }

    /**
     * Функция счетчика, выбирает все записи с статусом отремонтировано.
     * 
     * @return $query
     */
    public function count()
    {
        $db = new DataBaseController;
        $sql = "SELECT COUNT(*) as count FROM orders WHERE status = 'Отремонтировано'";

        $query = $db->pdo->query($sql);
        $query = $query->fetch();

        echo json_encode($query);
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
        $userController = new UsersController;
        $id          = $userController->getId();

        $db          = new DataBaseController;
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

    public function index()
    {
        $db = new DataBaseController;
        $sql = 'SELECT o.id,o.data, o.adress, c.name, o.photo_user, o.photo_admin FROM orders o INNER JOIN category c ON o.category_id = c.id WHERE status = "Отремонтировано" ORDER BY data LIMIT 4';
        $query = $db->pdo->query($sql);
        $query = $query->fetchALL();
        foreach ($query as $item) {
            echo '<div class="order">
            <h3>Дата: '.$item['data'].'</h3>
            <img class="img up" id ="'.$item['id'].'" src="'.$item['photo_user'].'">
            <img class="img down off" id ="'.$item['id'].'admin" src="'.$item['photo_admin'].'">
            <p class="text__center">Адрес: '.$item['adress'].'</p>
            <p class="text__center">Описание: '. $item['name'] .'</p>
            </div>';
        }
    }

    /**
     * Функция для удаления заявки
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


    
    public function update()
    {
        $post = $_POST;
        $files= $_FILES;
        $db = new DataBaseController;

        $id = $post['id'];
        $status = $post['status'];
        
        $newPrice = $post['newPrice'];

        $tmp         = $files['img']['tmp_name'];
        $img         = $files['img']['name'];
        $imgSize     = $files['img']['size'];
        $imgExtension= pathinfo($img, PATHINFO_EXTENSION);
        $allowedExtension = ['jpg', 'jpeg', 'png', 'bmp'];
        $allowedSize = 2097152;
        
        if (!empty($newPrice)) {
            $db->update($this->table,['status','end_price'],[$status,$newPrice],$id);
        }

        if (!empty($img)) {
            if ($imgSize < $allowedSize) {
                if (in_array($imgExtension, $allowedExtension)) {
                    $path = 'src/front/img/';
                    $rand = rand();
                    $imgEndPath = $path.$rand.$img;
                    if (move_uploaded_file($tmp, $imgEndPath)) {
                        $db->update($this->table,['status','photo_admin'],[$status,$imgEndPath],$id);
                        echo json_encode([
                            'success' => "sucess"
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
        } else {
            echo json_encode([
                'success' => "error",
                'message' => "А где картиночка?"
            ]);
        }
  
    }
}