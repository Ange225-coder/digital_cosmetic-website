<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\adminManagement\Products;
    use App\exceptions\adminManagementExceptions\ProductsExceptions;

    function getAProductDatasCtrl()
    {
        $get_product_datas = new Products();

        if(isset($_GET['product_id']) && is_numeric($_GET['product_id']) && $_GET['product_id'] > 0) {
            $product_id = $_GET['product_id'];

            $getting_p_datas = $get_product_datas->retrieveAProductData($product_id);
        }
        else {
            throw new ProductsExceptions(ProductsExceptions::errorMissingProductId());
        }

        return $getting_p_datas;
    }