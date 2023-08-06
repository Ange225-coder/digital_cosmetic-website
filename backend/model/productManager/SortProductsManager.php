<?php

    declare(strict_types = 1);

    namespace App\model\productManager;

    use App\model\database\DbManager;
    use App\model\paginations\PaginationsManager;
    require_once(__DIR__.'/../../controller/paginationsCtrl/paginationManagerCtrl.php');

    class SortProductsManager extends DbManager
    {
        /**
         * this function is used to sort
         * products based on radio button selected
         */
        public function sortProducts(string $category): array
        {
            $db = $this->dbConnect();
            $querySortProducts = $db->prepare('SELECT * FROM products WHERE p_category = ? LIMIT '.getStartPagination().', '.PaginationsManager::$product_by_page);
            $querySortProducts->execute(array($category));
            $getAllSorts = $querySortProducts->fetchAll();




            return $getAllSorts;
        }
    }