<?php

error_reporting(E_ERROR | E_PARSE);
spl_autoload_register('MyAutoloader::controllers');
spl_autoload_register('MyAutoloader::responses');
spl_autoload_register('MyAutoloader::services');
spl_autoload_register('MyAutoloader::exceptions');
spl_autoload_register('MyAutoloader::templates');
spl_autoload_register('MyAutoloader::models');


class MyAutoloader
{
    public static function responses($className)
    {
        $path = '../app/responses/';

        include $path . $className . '.php';
    }

    public static function services($className)
    {
        $path = '../app/services/';

        include $path . $className . '.php';
    }

    public static function controllers($className)
    {
        $path = '../app/controllers/';

        include $path . $className . '.php';
    }
    public static function exceptions($className)
    {
        $path = '../app/exceptions/';

        include $path . $className . '.php';
    }
    public static function templates($className)
    {
        $path = '../app/templates/';

        include $path . $className . '.php';
    }
    public static function models($className)
    {
        $path = '../app/models/';

        include $path . $className . '.php';
    }
}