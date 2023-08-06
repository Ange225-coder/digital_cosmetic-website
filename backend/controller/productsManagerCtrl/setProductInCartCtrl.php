<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    require_once('getAProductDatasCtrl.php');

    use App\model\productManager\ProductInCartManager;
    use App\exceptions\productManagerExceptions\ProductInCartManagerExceptions;

    function setProductInCartCtrl(): void
    {
        $set_product_inCart = new ProductInCartManager();

        $product_data = getAProductDatasCtrl();

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];

        $purchased_product = $product_data['p_name'];
        $product_img = $product_data['p_img'];

        $server_request = $_SERVER['REQUEST_METHOD'];

        if($server_request == 'POST') {
            $quantityToBuy = $_POST['quantityToBuy'];
            $taking_product = $_POST['taking_product'] ?? '';
            $buyer_location = strip_tags($_POST['location']);
            $buyer_name = strip_tags($name);
            $buyer_email = strip_tags($email);
            $buyer_contact = strip_tags($phone);


            if(isset($_GET['product_id']) && $_GET['product_id'] > 0 && is_numeric($_GET['product_id'])) {
                $product_id = $_GET['product_id'];

                /** check for if entered quantity is > to quantity in db */
                if($quantityToBuy > $product_data['p_price']) {
                    throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorQuantity());
                }

                /** calculate total price based on quantity to buy */
                $total_price = $product_data['p_price'] * $quantityToBuy;

                $product_inCart = $set_product_inCart->setProductInCart($buyer_name, $buyer_email, $buyer_contact, $purchased_product, $product_id, $taking_product, $quantityToBuy, $total_price, $buyer_location, $product_img);

                /** updating product quantity based on quantity to buy */
                if($product_inCart) {
                    $new_product_quantity = $product_data['p_quantity'] - $quantityToBuy;

                    $set_product_inCart->updatingProductQuantity($new_product_quantity, $product_id);
                }
            }
            else {
                throw new ProductInCartManagerExceptions(ProductInCartManagerExceptions::errorMissingProductId());
            }
        }
    }