<?php

    declare(strict_types = 1);

    namespace App\model\adminManagement;

    use App\model\database\DbManager;
    use App\model\paginations\PaginationsManager;

    class Products extends DbManager
    {
        /**
         * this function is used to insert
         * a product in db
         */
        public function addProduct(string $name, string $description, string $category, string $type, string $quantity, string $price, $img, string $img_type, int $img_size): bool
        {
            $db = $this->dbConnect();
            $queryInsertProduct = $db->prepare('INSERT INTO products(p_name, p_description, p_category, p_type, p_quantity, p_price, p_img, p_img_type, p_img_size) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?) ');

            return $queryInsertProduct->execute(array($name, $description, $category, $type, $quantity, $price, $img, $img_type, $img_size));
        }

        /**
         * this function is used to
         * get products in db
         */
        public function getProducts(): array
        {
            $db = $this->dbConnect();
            $queryGetProducts = $db->prepare('SELECT * FROM products ORDER BY product_id DESC LIMIT '.getStartPagination().', '.PaginationsManager::$product_by_page);
            $queryGetProducts->execute();
            $getAllProduct = $queryGetProducts->fetchall();

            if(count($getAllProduct) == 0) {
                header('location: ../../../frontend/views/admins/manageByAdmins/products/productsList.php');
            }

            return $getAllProduct;
        }

        /**
         * This function recovers the product
         * data when changing
         */
        public function retrieveAProductData($product_id)
        {
            $db = $this->dbConnect();
            $queryRetrieveAProductData = $db->prepare('SELECT * FROM products WHERE product_id = ?');
            $queryRetrieveAProductData->execute(array($product_id));

            return $queryRetrieveAProductData->fetch();
        }

        /**
         * this function is used to modify
         * a product based on its id
         */
        public function modifyProduct(string $product_name, string $product_description, string $type, string $product_quantity, string $product_price, string $product_id): bool
        {
            $db = $this->dbConnect();
            $queryModifyProduct = $db->prepare('UPDATE products SET p_name = ?, p_description = ?, p_type = ?, p_quantity = ?, p_price = ? WHERE product_id = ?');

            return $queryModifyProduct->execute(array($product_name, $product_description, $type, $product_quantity, $product_price, $product_id));
        }

        /**
         * this function is used to delete
         * a product based on its id
         */
        public function deleteProduct(string $product_id): bool
        {
            $db = $this->dbConnect();
            $queryDelProduct = $db->prepare('DELETE FROM products WHERE product_id = ?');

            return $queryDelProduct->execute(array($product_id));
        }


        /** this function get all order in process */
        public function getAllOrdersInProcess(): bool|array
        {
            $db = $this->dbConnect();
            $queryGetAllOrders = $db->prepare('SELECT *, DATE_FORMAT(order_date, "%d/%m/%Y à %Hh:%imin:%ss") as orderDate_fr FROM product_order ORDER BY order_date DESC');
            $queryGetAllOrders->execute();

            return $queryGetAllOrders->fetchAll();
        }


    }