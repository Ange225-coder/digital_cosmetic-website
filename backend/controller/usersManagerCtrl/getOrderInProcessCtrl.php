<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\usersManager\UsersManager;

    function getOrderInProcessCtrl(): bool|array
    {
        $get_orderInProcess = new UsersManager();

        //$email = $_SESSION['email'];

        return $get_orderInProcess->getOrderInProcess();
    }