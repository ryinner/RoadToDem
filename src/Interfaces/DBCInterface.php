<?php

namespace MasterOk\Interfaces;

/**
 * Интерфейс для DBC - DataBaseController, предназначен для
 * контроллеров, которые взаимодействуют с таблицами.
 * Обязятельно для всех контроллеров: метод получения
 */
interface DBCInterface
{
    public function get();
}