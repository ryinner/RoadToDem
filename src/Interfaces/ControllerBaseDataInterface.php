<?php

namespace MasterOk\Interfaces;

/**
 * Интерфейс ControllerBaseDataInterface, предназначен для
 * контроллеров, которые взаимодействуют с таблицами.
 * Обязятельно для всех контроллеров: метод получения,
 * создания, удаления.
 */
interface ControllerBaseDataInterface
{
    public function get();
    public function delete();
    public function add();
}