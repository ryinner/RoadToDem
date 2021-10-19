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
        var_dump($_POST);
        var_dump($_FILES);

    }

    public function delete()
    {
        
    }

    public function update()
    {
        
    }
}