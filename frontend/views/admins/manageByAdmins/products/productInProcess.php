<?php
    require_once('../../../../../backend/controller/adminManagementCtrl/displayOrdersInAdminOrderFile.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administration | Commandes en cours</title>
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/productInProcess.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <nav>
            <div class="nav-content">

                <div class="logo">
                    <a href="../../../../../index.php">
                        <img src="../../../../../public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                    </a>
                </div>

                <div class="logout">
                    <a href="../../../../../backend/logout/logout.php">Déconnexion</a>
                </div>
            </div>
        </nav>

        <?php if(count(displayOrdersInAdminOrderFile()) == 0): ?>
            <section class="no-order">
                <div class="content">
                    <div class="img">
                        <img src="../../../../../public/pics/ad-p-process-no-order.svg" alt="digital_cosmetics_heavy_box">
                    </div>

                    <div class="text">
                        <h1>Aucune commande pour le moment</h1>

                        <h2>Les commandes non traitées s'afficheront ici</h2>
                    </div>
                </div>
            </section>
        <?php endif; ?>



        <?php if(count(displayOrdersInAdminOrderFile()) >= 1): ?>
            <section class="order">

                <div class="order-content">
                    <h1 class="title-block">Commandes non traités (<?= count(displayOrdersInAdminOrderFile()); ?>)</h1>

                    <hr>

                    <div class="items">
                        <?php foreach(displayOrdersInAdminOrderFile() as $get_orders): ?>

                            <div class="items--flex">
                                <div class="img">
                                    <?php if(!empty($get_orders['p_img'])) :?>
                                        <?php $imgData = base64_encode($get_orders['p_img']); ?>

                                        <img src="data:;base64, <?= $imgData; ?>" alt="<?= $get_orders['purchased_product'] ?>" width="200">
                                    <?php endif; ?>
                                </div>

                                <div class="items-texts">
                                    <h1><?= $get_orders['purchased_product']; ?></h1>

                                    <p class="order-number--grey">Commande 00-<?= $get_orders['order_id']; ?></p>

                                    <p class="status">Non traité</p>

                                    <p class="date">Le <?= $get_orders['orderDate_fr']; ?></p>
                                </div>

                                <div class="items-links">
                                    <a href="checkingOrder.php?order_id=<?= $get_orders['order_id']; ?>">Détails</a>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                </div>

            </section>
        <?php endif; ?>
    </body>
</html>