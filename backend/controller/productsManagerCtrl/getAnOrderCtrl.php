<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../../'.$path);
    });

    use App\model\productManager\ProductInCartManager;
    use App\exceptions\productManagerExceptions\ProductInCartManagerExceptions;

    function getAnOrderCtrl()
    {
        $get_anOrder = new ProductInCartManager();

        if(isset($_GET['order_id']) && $_GET['order_id'] > 0 && is_numeric($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            $get_order = $get_anOrder->getAnOrder($order_id);
        }
        else {
            throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorMissingOrderId());
        }

        return $get_order;
    }