<?php

class Autoload
{

    public function init()
    {
        spl_autoload_register(function ($class_name) {
            $path = BP . '/app/code/' . $class_name . '.php';
            $path = str_replace("\\", "/", $path);
            // die($path);
            @include $path;
        });

        // for composer packages
        require_once BP . '/vendor/autoload.php';
    }
}