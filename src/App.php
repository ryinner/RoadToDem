<?php

namespace MasterOk;

/**
 * Класс приложения, который содержит в себе php-компоненты
 */
class App
{
    /**
     * Функция для запуска приложения
     *
     * @return void
     */
    public function run()
    {
        $this->registerControllers();
    }

    /**
     * Регистрация всех контроллеров в классе приложения
     * Контроллеры перебераются как ключ и пространство имен класса после чего
     * Ключ становится свойством объекта, которое содержит класс.
     * 
     * @return void
     */
    public function registerControllers()
    {
        $controllers = require_once 'Config/Controllers.php';
        foreach ($controllers as $key => $controller)
        {
            $this->$key = new $controller;
        }
    }
}

