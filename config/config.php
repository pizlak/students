<?php
define('PATH', dirname(__DIR__) . '/');  // константа диррективы
spl_autoload_register(function ($class) { // автозагрузка
    $path = PATH . $class . '.php';
    if (file_exists($path)) {
        include $path;
    }
});
