<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\productManager\ProcessedProductManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function getUserProcessedOrderCtrl(): array
    {
        $getUserOrder = new ProcessedProductManager();

        if(isset($_SESSION['name'])) {
            $user_session = $_SESSION['name'];

            $userOrder = $getUserOrder->getUserProcessedOrder($user_session);
        }
        else {
            throw new UsersManagerExceptions(UsersManagerExceptions::errorMissingUserSession());
        }

        return $userOrder;
    }