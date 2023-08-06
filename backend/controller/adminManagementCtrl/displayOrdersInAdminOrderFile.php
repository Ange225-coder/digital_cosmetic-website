<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../../'.$path);
    });

    use App\model\adminManagement\Products;

    function displayOrdersInAdminOrderFile(): bool|array
    {
        $get_all_orders = new Products();

        return $get_all_orders->getAllOrdersInProcess();
    }