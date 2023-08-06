<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    require_once('getAnOrderCtrl.php');

    use App\model\productManager\ProcessedProductManager;
    use App\model\adminManager\AdminManage;
    use App\exceptions\productManagerExceptions\ProductInCartManagerExceptions;

    function setOrderProcessedCtrl(): void
    {
        $order_processed = new ProcessedProductManager();
        $delOrder = new ProcessedProductManager();
        $admin = new AdminManage();

        $dataOfOrderInProcess = getAnOrderCtrl();

        $buyer_name = $dataOfOrderInProcess['buyer_name'] ?? '';
        $buyer_contact = $dataOfOrderInProcess['buyer_contact'] ?? '';
        $buyTo = $dataOfOrderInProcess['total_price'] ?? '';
        $buyer_location = $dataOfOrderInProcess['buyer_location'] ?? '';
        $p_img = $dataOfOrderInProcess['p_img'] ?? '';
        $order_date = $dataOfOrderInProcess['order_date'] ?? '';
        $product_purchased = $dataOfOrderInProcess['purchased_product'] ?? '';
        $product_id = $dataOfOrderInProcess['product_id'];

        $admin_session = $_SESSION['username'];

        $admin_username = $admin->getAdminForConnexion($admin_session);

        $server_request = $_SERVER['REQUEST_METHOD'];

        if(isset($_GET['order_id']) && $_GET['order_id'] > 0 && is_numeric($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            if($server_request == 'POST') {
                $password = $_POST['password'];

                if($admin_username && password_verify($password, $admin_username['a_password'])) {

                    /** insert data recovered in order processed database  */
                    $productInsertionInOrderProcessedTable = $order_processed->setOrderProcessed($buyer_name, $buyer_contact, $product_purchased, $product_id, $buyTo, $buyer_location, $p_img, $order_date);

                    if($productInsertionInOrderProcessedTable) {
                        $delOrder->deleteOrderInProcess($order_id);

                        $_SESSION['order_processed_success'] = 'Félicitation une commande vient d\'être validé avec succès';

                        header('location: ../../../frontend/views/admins/homepage/adminHomepage.php');
                    }
                }
                else {
                    throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorWrongAdminPass().'('.$password.')');
                }
            }
        }
        else {
            throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorMissingProductId());
        }
    }