<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\searchesManager\SearchesManager;
    use App\exceptions\searchesExceptions\ProductSearchesExceptions;

    function getSearchedProductCtrl(): array
    {
        $searchedProduct = new SearchesManager();

        $product_keyword = trim($_GET['product_searches'] ?? '');

        if(!$product_keyword) {
            throw new ProductSearchesExceptions(ProductSearchesExceptions::errorMissingKeyword());
        }

        $product_keyword_entered = strip_tags($product_keyword);

        return $searchedProduct->getSearchedProduct($product_keyword_entered);
    }