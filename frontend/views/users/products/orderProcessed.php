<?php

    if(!isset($_SESSION)) {
        session_start();
        $name = $_SESSION['name'] ?? '';
        $email = $_SESSION['email'] ?? '';

        //if(!$name || !$email) {
            //header('location: ../regist_auth/login.php');
        //}
    }

    require_once('../../../../backend/controller/usersManagerCtrl/getUserProcessedOrderCtrl.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Mes commandes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/orderProcessed.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>

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
                        <summary><span class="user"><i class="bi bi-person-check"></i> <span> Bonjour</span> <i class="bi bi-chevron-down"></i></span>   <i class="bi bi-list" title="menu" id="menuHamburger"></i></summary>
                        <div>
                            <!--<a href="../settings/userSettings.php" class="--black --borderR"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a> -->
                            <a href="orderProcessed.php" class="--black"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>

                            <hr >

                            <a href="../../../../backend/logout/logout.php" class="--center logout">Déconnexion</a>
                        </div>
                    </details>
                </div>
            </div>
        </nav>



        <div class="section-block">
            <section>
                <h1 class="block-title">Vos commandes</h1>

                <hr class="first-line">


                <div class="order-content">

                    <h2>Commandes ouvertes (<?= count(getUserProcessedOrderCtrl()); ?>)</h2>

                    <hr>

                    <!-- aucune commande block -->
                    <?php if(count(getUserProcessedOrderCtrl()) == 0): ?>

                        <div class="no-order"> <!-- block si aucune commandes -->
                            <div>
                                <span class="material-symbols-outlined">add_shopping_cart</span>

                                <h3>Vous n'avez passé aucune commande !</h3>

                                <p>Toutes vos commandes seront sauvegardées ici pour que vous puissiez consulter leur statut à tout moment</p>

                                <a href="../../../../index.php">Poursuivez vos achats</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- aucun commande fin block -->


                    <!-- commande >= 1 block -->
                    <?php if(count(getUserProcessedOrderCtrl()) >= 1): ?>

                        <?php foreach(getUserProcessedOrderCtrl() as $orderProcessed): ?>

                            <div class="orders-block"> <!-- pour placer les block orders en grid -->
                                <div class="orders">

                                    <div class="product-purchased">

                                        <div class="img">
                                            <?php if(!empty($orderProcessed['p_img'])): ?>
                                                <?php $imgData = base64_encode($orderProcessed['p_img']); ?>

                                                <img src="data:;base64, <?= $imgData; ?>" alt="<?= $orderProcessed['product_purchased']; ?>" width="200">
                                            <?php endif; ?>
                                        </div>

                                        <div class="order-description">

                                            <h1><?= $orderProcessed['product_purchased']; ?></h1>

                                            <p class="order-description-id">
                                                Commande 00<?= $orderProcessed['order_processed_id'];  ?>
                                            </p>

                                            <p class="order-description-status">
                                                <?= $orderProcessed['product_status']; ?>
                                            </p>

                                            <p class="order-description-date">
                                                Le <?= $orderProcessed['orderProcessedDateFr']; ?>
                                            </p>
                                        </div>
                                    </div>

                                    <p>
                                        <a href="putAproductInCart.php?product_id=<?= $orderProcessed['product_id']; ?>">Recommander</a>
                                    </p>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>
                    <!-- command >= 1 fin block -->
                </div>
            </section>
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