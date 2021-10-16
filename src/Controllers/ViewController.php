<?php

namespace MasterOk\Controllers;

/**
 * Контроллер для всех представлений в приложении
 */

class ViewController
{
    public $dir = __DIR__.'/../views';

    /**
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Функция инициализации внешнего вида из основно слоя и переменной для контента страницы
     *
     * @param string $content
     * @return void
     */
    public function init(string $content)
    {
        $dir = $this->dir;
        require_once $dir.'/layout/header.php';
        require_once $dir.$content;
        require_once $dir.'/layout/footer.php';
    }
}

