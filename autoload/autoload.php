<?php

    spl_autoload_register(function($fqcn): void {
        $class = str_replace('\\', '/', $fqcn);
        $file = __DIR__.'/../backend/model/'.$class.'.php';

        if(file_exists($file)) {
            require_once($file);
        }
    });