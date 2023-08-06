<?php

    declare(strict_types = 1);

    namespace App\model\productManager;

    use App\model\database\DbManager;

    class ProcessedProductManager extends DbManager
    {
        /**
         * this function inserts the data of the orders in progress
         * recovered in the database of the orders processed
         */
        public function setOrderProcessed(string $buyer_name, string $buyer_contact, string $product_purchased, int $product_id, int $buyTo, string $buyer_location, $img, $order_date): bool
        {
            $db = $this->dbConnect();
            $querySetOrderProcessed = $db->prepare('INSERT INTO order_processed(buyer_name, buyer_contact, product_purchased, product_id, buyTo, buyer_location, p_img, order_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?) ');

            return $querySetOrderProcessed->execute(array($buyer_name, $buyer_contact, $product_purchased, $product_id, $buyTo, $buyer_location, $img, $order_date));
        }

        /** delete order in process based on his id */
        public function deleteOrderInProcess($order_id): bool
        {
            $db = $this->dbConnect();
            $queryDeleteOrderInProcess = $db->prepare('DELETE FROM product_order WHERE order_id = ?');

            return $queryDeleteOrderInProcess->execute(array($order_id));
        }

        /** get user's processed commands based on their session */
        public function getUserProcessedOrder($buyer_name): array
        {
            $db = $this->dbConnect();
            $queryGetUserProcessedOrder = $db->prepare('SELECT *, DATE_FORMAT(order_date, "%d-%m-%Y") as orderProcessedDateFr FROM order_processed WHERE buyer_name = ? ORDER BY order_date DESC');
            $queryGetUserProcessedOrder->execute(array($buyer_name));

            return $queryGetUserProcessedOrder->fetchAll();
        }
    }