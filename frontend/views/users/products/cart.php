<?php

    if(!isset($_SESSION)) {
        session_start();
        $name = $_SESSION['name'] ?? '';
        $email = $_SESSION['email'] ?? '';

        if(!$name || !$email) {
            header('location: ../regist_auth/login.php');
        }
    }

    require_once('../../../../backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');
    require_once('../../../../backend/controller/productsManagerCtrl/getTotalPriceCtrl.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="ut-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mon panier</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/cart.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
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
                        <summary><span class="user"><i class="bi bi-person-check"></i> <span> <?= $name; ?></span> <i class="bi bi-chevron-down"></i></span>   <i class="bi bi-list" title="menu" id="menuHamburger"></i></summary>
                        <div>
                            <a href="../settings/userSettings.php" class="--black --borderR"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                            <a href="orderProcessed.php" class="--black"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>


                                <hr >

                                <a href="../../../../backend/logout/logout.php" class="--center logout">Déconnexion</a>

                        </div>
                    </details>
                </div>
            </div>
        </nav>


        <?php if(count(getOrderInProcessCtrl()) == 0): ?>
            <section class="empty-cart">
                <div>
                    <p class="basket">
                        <i class="bi bi-cart4"></i>
                    </p>

                    <h1>Votre panier est vide!</h1>

                    <p class="--marg">Parcourez nos catégories et découvrez le produit qui convient à vos besoins</p>


                    <a href="../../../../index.php">Commencer vos achats</a>
                </div>
            </section>
        <?php endif; ?>



        <div class="order">

            <?php if(count(getOrderInProcessCtrl()) >= 1): ?>
                <section class="cart-fill">

                    <div class="cart"> <!-- block qui prend en compte le produit en panier -->
                        <h1 class="basket">Panier (<?= count(getOrderInProcessCtrl()); ?>)</h1>

                        <hr class="line">

                        <!-- debut du foreach qui recupère les commandes en cours de l'utilisateur connecté -->
                        <?php foreach (getOrderInProcessCtrl() as $order): ?>

                            <div class="purchased-block"> <!-- le block où se trouve le produit sa description et le total de celui-ci -->

                                <div class="product-block"> <!-- block du produit uniquement -->

                                    <div class="img"> <!-- block de l'image du produit -->
                                        <?php if(!empty($order['p_img'])): ?>
                                            <?php $img_data = base64_encode($order['p_img']); ?>

                                            <img src="data:;base64, <?= $img_data ?>" alt="digital-cosmetics<?= $order['purchased_product']; ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="description"> <!-- block de la description du produit -->
                                        <h1><?= $order['purchased_product']; ?></h1>

                                        <p class="available">Disponible</p>

                                        <h2>
                                            Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                                        </h2>

                                        <p>Commande en cours de traitement</p>
                                    </div>

                                </div>

                                <div class="price"> <!-- block de la somme totale du produit -->
                                    <p>
                                        <span>Total:</span>  <span><?= $order['total_price']; ?> FCFA</span>
                                    </p>

                                    <p>
                                        <span>Quantité:</span> <span class="quantity"><?= $order['product_quantity']; ?></span>
                                    </p>
                                </div>

                            </div>

                            <hr class="product-line">
                        <?php endforeach; ?>
                        <!-- fin du foreach -->
                    </div>

                    <div class="cart-summary"> <!-- block qui prend en compte la somme des produits du panier -->
                        <h1>Résumé du panier</h1>

                        <hr >

                        <div class="total">
                            <p>Sous-total</p>

                            <p>
                                <?php foreach(getTotalPriceCtrl() as $total): ?>
                                    <?= $total['allTotal']; ?> FCFA
                                <?php endforeach; ?>
                            </p>
                        </div>

                        <hr >

                        <div class="selling-info">
                            <div>
                                <i class="bi bi-check2-circle"></i>
                            </div>

                            <div>
                                <p>
                                    Les articles Digital Cosmetics sont éligibles à livraison gratuite.
                                </p>

                                <h2>
                                    Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>



        <footer>
            <div>
                <p>
                    Digital Cosmetics - Tous droits réservés  <span> <a href="https://api.whatsapp.com/send?phone=2250160318959" class="whats" target="_blank"><i class="bi bi-whatsapp"></i></a></span>
                </p>
            </div>
        </footer>
    </body>
</html>