<?php

    declare(strict_types = 1);

    namespace App\model\searchesManager;

    use App\model\database\DbManager;

    class SearchesManager extends DbManager
    {
        /** this function do searches on product table based on it product type */
        public function getSearchedProduct(string $product_type): bool|array
        {
            $db = $this->dbConnect();

            /** trim on p_type here for remove blank space in retrieving product type */
            $queryGetSearchedProduct = $db->prepare('SELECT * FROM products WHERE trim(p_type) LIKE ?');
            $queryGetSearchedProduct->execute(array($product_type));

            return $queryGetSearchedProduct->fetchAll();
        }
    }