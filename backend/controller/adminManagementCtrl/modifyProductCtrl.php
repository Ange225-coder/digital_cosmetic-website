<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\adminManagement\Products;
    use App\exceptions\adminManagementExceptions\ProductsExceptions;

    function modifyProductCtrl(): void
    {
        $modify_product = new Products();

        if(isset($_GET['product_id']) && is_numeric($_GET['product_id']) && $_GET['product_id'] > 0) {
            $product_id = $_GET['product_id'];

            if(isset($_POST['new_p_quantity']) && is_numeric($_POST['new_p_quantity']) && $_POST['new_p_quantity'] >= 0) {
                $new_p_quantity = $_POST['new_p_quantity'];

                if(isset($_POST['new_p_price']) && is_numeric($_POST['new_p_price']) && $_POST['new_p_price'] > 0) {
                    $new_p_price = strip_tags($_POST['new_p_price']);

                    if(isset($_POST['new_p_name']) && isset($_POST['new_p_description']) && isset($_POST['new_p_type'])) {
                        $new_p_name = strip_tags($_POST['new_p_name']);
                        $new_p_description = strip_tags($_POST['new_p_description']);
                        $new_p_type = strip_tags($_POST['new_p_type']);

                        $modify_product->modifyProduct($new_p_name, $new_p_description, $new_p_type, $new_p_quantity, $new_p_price, $product_id);

                        $_SESSION['product_modify_done'] = 'Modification du produit réussi';
                    }
                }
                else {
                    throw new ProductsExceptions(ProductsExceptions::errorPrice());
                }
            }
            else {
                throw new ProductsExceptions(ProductsExceptions::errorQuantity());
            }
        }
        else {
            throw new ProductsExceptions(ProductsExceptions::errorProductId());
        }
    }