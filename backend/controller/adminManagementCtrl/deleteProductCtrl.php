<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\adminManagement\Products;
    use App\model\adminManager\AdminManage;
    use App\exceptions\adminManagementExceptions\ProductsExceptions;

    function deleteProductCtrl(): bool
    {
        $product_deletion = new Products();
        $get_admin_username = new AdminManage();

        if(isset($_GET['product_id']) && is_numeric($_GET['product_id']) && $_GET['product_id'] > 0) {
            $product_id = $_GET['product_id'];
            $admin_username = $_SESSION['username'];

            if(isset($_POST['admin_pass'])) {
                $admin_pass = $_POST['admin_pass'];
                $username = $get_admin_username->getAdminForConnexion($admin_username);

                if($username && password_verify($admin_pass, $username['a_password'])) {

                    $delete_product = $product_deletion->deleteProduct($product_id);

                    $_SESSION['deletion_done'] = 'Un produit vient d\'être retirer de la base de données';
                }
                else {
                    throw new ProductsExceptions(ProductsExceptions::errorProductDeletion());
                }
            }
            else {
                throw new ProductsExceptions(ProductsExceptions::errorAdminPassEmpty());
            }
        }
        else {
            throw new ProductsExceptions(ProductsExceptions::errorFieldEmpty());
        }

        return $delete_product;
    }