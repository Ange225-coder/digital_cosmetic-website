<?php

    declare(strict_types = 1);

    use App\model\paginations\PaginationsManager;

    //this function obtain the current page
    function getCurrentPage(): int|string
    {
        if(isset($_GET['page'])) {
            PaginationsManager::$page = $_GET['page'];
        }

        if(!isset(PaginationsManager::$page)) {
            PaginationsManager::$page = 1;
        }

        return PaginationsManager::$page;
    }


    //this function is used to start pagination
    function getStartPagination(): int
    {
        return (getCurrentPage() - 1) * PaginationsManager::$product_by_page;
    }


    /**
     * this function is used to do products paginations
     * based on the number of links
     * Used in index
     */
    function getLinkForProductsPagination(): float
    {
        $get_product_link = new PaginationsManager();

        return ceil($get_product_link->getProductsPagination() / PaginationsManager::$product_by_page);
    }

    /**
     * this function is used to do pagination in
     * productSortBy.php based on the number of link
     */
    function getLinkForSortingPagination(): float
    {
        $get_sorting_link = new PaginationsManager();

        return ceil($get_sorting_link->getSortingPagination() / PaginationsManager::$product_by_page);
    }


