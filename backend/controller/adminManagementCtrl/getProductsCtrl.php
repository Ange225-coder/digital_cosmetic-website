<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../../'.$path);
    });

    use App\Model\AdminManagement\Products;

    function getProductsCtrl(): array
    {
        $get_products = new Products();

        return $get_products->getProducts();
    }