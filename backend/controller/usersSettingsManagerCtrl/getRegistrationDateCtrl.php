<?php

    declare(strict_types = 1);

    //require_once(__DIR__.'/../../../autoload/autoload.php');

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;

    function getRegistrationDateCtrl(string $email)
    {
        $get_date = new UsersSettingsManager();

        return $get_date->getRegistrationDate($email);
    }