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
        $category    = $post['category'];
        $tmp         = $files['img']['tmp_name'];
        $img         = $files['img']['name'];
        $imgSize     = $files['img']['size'];
        $imgExtension= pathinfo($img, PATHINFO_EXTENSION);

        $allowedExtension = ['jpg', 'jpeg', 'png', 'bmp'];
        $allowedSize = 2097152;

        if ($imgSize < $allowedSize) {
            if (in_array($imgExtension, $allowedExtension)) {
                $db->insert($this->table,[],[]);
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
        
    }

    public function update()
    {
        
    }
}