<?php

    declare(strict_types = 1);

    namespace App\model\paginations;

    use App\model\database\DbManager;

    class PaginationsManager extends DbManager
    {
        /**
         * this variable manage number of
         * element(products) to display by page
         * use in index ang equally in the page productSortBy.php
         */
        public static int $product_by_page = 20;


        /**
         * this variable contain the current
         * page
         */
        public static $page = null;

        /**
         * this function manage products pagination
         */
        public function getProductsPagination()
        {
            $db = $this->dbConnect();
            $queryGetProductPagination = $db->prepare('SELECT COUNT(*) as productsPagination FROM products');
            $queryGetProductPagination->execute();
            $product_counter = $queryGetProductPagination->fetchAll();

            return $product_counter[0]['productsPagination'];
        }

        /**
         * this function manage product pagination in productSortBy.php
         */
        public function getSortingPagination()
        {
            $db = $this->dbConnect();
            $queryGetSortingPagination = $db->prepare('SELECT COUNT(*) as sortingPagination FROM products');
            $queryGetSortingPagination->execute();
            $sorting_product_counter = $queryGetSortingPagination->fetchAll();

            return $sorting_product_counter[0]['sortingPagination'];
        }
    }