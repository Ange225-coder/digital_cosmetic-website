<?php
    if(!isset($_SESSION)) {
        session_start();
        $name = $_SESSION['name'] ?? '';
        $email = $_SESSION['email'] ?? '';

        if(!$name || !$email) {
            header('location: ../regist_auth/login.php');
        }
    }

    require_once('../../../../backend/controller/productsManagerCtrl/getAProductDatasCtrl.php');
    require_once('../../../../backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');

    try {
        $get_product_data = getAProductDatasCtrl();
    }
    catch(\Throwable $t) {
        $error_missing_productId = $t->getMessage();
    }


?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mise en panier de <?= $get_product_data['p_name']; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/putProductInCart.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <nav>
            <div class="nav-content">
                <div class="logo">
                    <h1>
                        <a href="../../../../index.php">
                            <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                        </a>
                    </h1>
                </div>

                <div class="user-block">

                    <details>
                        <summary><span class="user"><i class="bi bi-person-check"></i> <span><?= $name; ?></span> <i class="bi bi-chevron-down"></i></span>   <i class="bi bi-list" title="menu" id="menuHamburger"></i></summary>
                        <div>
                            <a href="../settings/userSettings.php" class="--black --borderR"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                            <a href="orderProcessed.php" class="--black"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>

                            <hr >

                            <a href="../../../../backend/logout/logout.php" class="--center logout">Déconnexion</a>
                        </div>
                    </details>


                    <div class="basket">
                        <a href="cart.php">
                            <i class="bi bi-cart3"></i><sup><?= count(getOrderInProcessCtrl()); ?></sup> <span>Panier</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>


        <section>
            <div class="product-presentation">

                <div class="product-presentation__img">
                    <?php if(!empty($get_product_data['p_img'])): ?>
                        <?php $imgData = base64_encode($get_product_data['p_img']); ?>

                        <img src="data:;base64, <?= $imgData ?>" alt="<?= $get_product_data['p_name'] ?>">
                    <?php endif; ?>
                </div>

                <div class="product-presentation__features">
                    <h1><?= $get_product_data['p_name']; ?></h1>

                    <p class="description"><?= $get_product_data['p_description']; ?></p>

                    <?php if($get_product_data['p_quantity'] == 0): ?>
                        <p>
                            <span class="unavailable">stock épuisé</span>
                        </p>
                    <?php else :?>
                        <p>
                            <span class="available">Disponible</span>
                        </p>
                    <?php endif; ?>

                    <hr >

                    <h2><?= $get_product_data['p_price']; ?> Fcfa</h2>

                    <p class="remaining-items">
                        <?php if($get_product_data['p_quantity'] >= 2): ?>
                            <span>Quelques articles restant</span>

                        <?php elseif($get_product_data['p_quantity'] == 1): ?>
                            <span>1 seul article restant</span>

                        <?php elseif($get_product_data['p_quantity'] == 0): ?>
                            <span>Indisponible pour l'instant</span>
                        <?php endif;?>
                    </p>

                    <?php if($get_product_data['p_quantity'] == 0): ?>

                    <?php else: ?>
                        <p class="delivery">Livraison gratuite si quantité achetée est supérieur à 3</p>
                    <?php endif; ?>


                    <?php if($get_product_data['p_quantity'] == 0): ?>
                        <div class="notice">
                            <p>
                                Le stock du produit est épuisé.
                                Contacter le fournisseur pour obtenir la procédure d'achat de ce produit.
                            </p>

                            <p class="notice--bg">
                                <a href="https://api.whatsapp.com/send?phone=2250160318959" target="_blank"><i class="bi bi-whatsapp"></i> <span>Contacter le fournisseur</span></a>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <!-- fin de presentation du produit -->

            <div class="finalize-purchase">
                <h1>Finaliser l'achat du produit</h1>

                <hr >

                <form method="POST" action="../../../../backend/router/router.php?action=setProductInCartCtrl&amp;product_id=<?= $get_product_data['product_id']; ?>">

                    <div class="quantity">
                        <label for="quantityToBuy">
                            <p>Quantité de produit à acheter</p>
                            <input type="number" name="quantityToBuy" id="quantityToBuy" min="1" max="<?= $get_product_data['p_quantity']; ?>" required>
                        </label>
                    </div>


                    <div class="radio">

                        <p>Sélectionner une option</p>

                        <div class="radio-wrapper">
                            <label for="deliver">Faire livrer le produit</label>
                            <input type="radio" name="taking_product" value="livraison" id="deliver" required>
                        </div>

                        <div class="radio-wrapper --marg">
                            <label for="onSpot">Prendre sur place</label>
                            <input type="radio" name="taking_product" value="sur place" id="onSpot" required>
                        </div>
                    </div>


                    <div class="location">
                        <label for="location">
                            <p>Localité</p>
                            <input type="text" name="location" id="location" placeholder="EX: Cocody La Corniche - en face ancien Nestlé" required>
                        </label>
                    </div>

                    <?php if($get_product_data['p_quantity'] == 0): ?>

                    <?php else: ?>
                        <div class="btn">
                            <i class="bi bi-cart-plus"></i>
                            <button type="submit">J'achète</button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>

        </section>


        <footer>
            <div>
                <p>
                    Digital Cosmetics - Tous droits réservés  <span> <a href="https://api.whatsapp.com/send?phone=2250160318959" class="whats" target="_blank"><i class="bi bi-whatsapp"></i></a></span>
                </p>
            </div>
        </footer>

    </body>
</html>