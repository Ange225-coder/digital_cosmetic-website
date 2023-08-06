<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\productManager\SortProductsManager;
    use App\exceptions\adminManagementExceptions\ProductsExceptions;

    function sortProductsCtrl(): array
    {
        $sort_products = new SortProductsManager();

        //this if add session for each category
        if(isset($_POST['category'])) {
            $category = $_POST['category'];

            $_SESSION['category'] = $category;
        }

        //this if sort products based on category
        if(isset($_SESSION)) {

            $category = $_SESSION['category'];

            $gettingSorts = $sort_products->sortProducts($category);
        }
        else {
            throw new ProductsExceptions(ProductsExceptions::errorRightCategory());
        }

        return $gettingSorts;
    }


