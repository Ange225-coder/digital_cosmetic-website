<?php

    if(!isset($_SESSION)) {
        session_start();

        if(!isset($_SESSION['username'])) {
            header('location: ../../admin_regist_auth/adminLogin.php');
        }
    }


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Administration | Ajouter un produit</title>
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/addProduct.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>
        <section>
            <h1>Ajouter un produit</h1>

            <div class="form-block">
                <form method="POST" enctype="multipart/form-data" action="../../../../../backend/router/router.php?action=addProductCtrl">

                    <p class="error">
                        <?php if(isset($error_product_insertion)): ?>
                            <?= $error_product_insertion ?>
                        <?php endif; ?>
                    </p>

                    <div class="product_name --input">
                        <label for="product_name">Nom du produit</label>
                        <input type="text" name="product_name" id="product_name" required>
                    </div>

                    <hr >

                    <div class="product_description">
                        <label for="product_description">Description</label>
                        <textarea name="product_description" id="product_description" placeholder="Description" required></textarea>
                    </div>

                    <hr >

                    <div class="btn-radio">
                        <div>
                            <label for="health"> Santé</label>
                            <input type="radio" name="category" value="Santé" id="health" required>
                        </div>


                        <div>
                            <label for="cosmetics"> Cosmetics</label>
                            <input type="radio" name="category" value="Cosmetics" id="cosmetics" required>
                        </div>

                    </div>

                    <hr >

                    <div class="product_type --input">
                        <label for="product_type">Type</label>
                        <input type="text" name="product_type" id="product_type" placeholder="Entrer le type défini du produit en un mot: savon, parfum, lotion..." required>
                    </div>

                    <hr >

                    <div class="product_quantity --input">
                        <label for="product_quantity">Quantité</label>
                        <input type="number" name="product_quantity" id="product_quantity" min="0" required>
                    </div>

                    <hr >

                    <div class="product_price --input">
                        <label for="product_price">Prix</label>
                        <input type="text" name="product_price" id="product_price" required>
                    </div>

                    <hr >

                    <div class="product_img">
                        <label for="product_img">Charger le produit</label>
                        <input type="file" name="product_img" id="product_img" required>
                    </div>

                    <hr >

                    <div class="btn">
                        <button type="submit">Ajouter un produit</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>



