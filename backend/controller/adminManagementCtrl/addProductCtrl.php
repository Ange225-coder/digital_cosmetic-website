<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '//'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\Model\AdminManagement\Products;
    use App\Exceptions\AdminManagementExceptions\ProductsExceptions;

    function addProductCtrl(): void
    {
        $product_insertion = new Products();

        if(isset($_POST['product_name']) && isset($_POST['product_description'])) {
            $name = strip_tags($_POST['product_name']);
            $description = strip_tags($_POST['product_description']);

            if(isset($_POST['category'])) {
                $category = $_POST['category'];

                if(isset($_POST['product_type'])) {
                    $product_type = strip_tags($_POST['product_type']);

                    if(isset($_POST['product_quantity']) && is_numeric($_POST['product_quantity']) && $_POST['product_quantity'] >= 0) {
                        $quantity = $_POST['product_quantity'];

                        if(isset($_POST['product_price']) && is_numeric($_POST['product_price']) && $_POST['product_price'] > 0) {
                            $price = $_POST['product_price'];

                            if(isset($_FILES['product_img'])) {
                                $img_name = $_FILES['product_img']['name'];
                                $img_size = $_FILES['product_img']['size'];
                                $img_type = $_FILES['product_img']['type'] ?? '';
                                $img_tmp = $_FILES['product_img']['tmp_name'] ?? '';

                                if($img_size > 2000000) {
                                    throw new ProductsExceptions(ProductsExceptions::errorProductImgSize());
                                }

                                if(isset($img_type)) {
                                    $img_path_info = pathinfo($img_name);
                                    $img_extension = $img_path_info['extension'];

                                    $allowed_extensions = ['jpg', 'jpeg', 'webp', 'png'];

                                    if(in_array($img_extension, $allowed_extensions)) {
                                        $product_insertion->addProduct($name, $description, $category, $product_type, $quantity, $price, file_get_contents($img_tmp), $img_type, $img_size);
                                    }
                                    else {
                                        throw new ProductsExceptions(ProductsExceptions::errorImgExtension());
                                    }
                                }
                                else {
                                    throw new ProductsExceptions(ProductsExceptions::errorImgTypeNotFound());
                                }
                            }
                            else {
                                throw new ProductsExceptions(ProductsExceptions::errorImgInsertion());
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
                    throw new ProductsExceptions(ProductsExceptions::errorMissingProductType());
                }
            }
            else {
                throw new ProductsExceptions(ProductsExceptions::errorCategoryNotExists());
            }
        }
        else {
            throw new ProductsExceptions(ProductsExceptions::errorFieldEmpty());
        }
    }