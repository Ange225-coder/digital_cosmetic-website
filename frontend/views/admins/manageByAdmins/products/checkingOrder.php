<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
    }

    require_once('../../../../../backend/controller/productsManagerCtrl/getAnOrderCtrl.php');

    $getAnOrder = getAnOrderCtrl();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Valider une commande</title>
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/checkingOrder.css">
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


        <section>
            <h1>Détails de la commande</h1>

            <hr>

            <div class="product">
                <div class="img">
                    <?php if(!empty($getAnOrder['p_img'])): ?>
                        <?php $imgData = base64_encode($getAnOrder['p_img']); ?>

                        <img src="data:;base64, <?= $imgData; ?>" alt="<?= $getAnOrder['purchased_product'] ?>" width="200">
                    <?php endif; ?>
                </div>

                <hr class="secondLine">

                <div class="order-details">
                    <div class="user-info">
                        <p>
                            <em>Acheteur: </em> <strong><?= $getAnOrder['buyer_name']; ?></strong>
                        </p>

                        <p>
                            <em>Email: </em> <strong><?= $getAnOrder['buyer_email']; ?></strong>
                        </p>

                        <p>
                            <em>Contact: </em> <strong><?= $getAnOrder['buyer_contact']; ?></strong>
                        </p>

                        <p>
                            <em>Localité: </em> <strong><?= $getAnOrder['buyer_location']; ?></strong>
                        </p>

                        <p>
                            <em>Faire livré / prendre sur place: </em> <strong><?= $getAnOrder['product_taking']; ?></strong>
                        </p>
                    </div>

                    <div class="order-details__middle"></div>
                    <hr class="order-details__otherMiddleLine">

                    <div class="order-info">
                        <p>
                            <em>ID de commande: </em> <strong><?= $order_id; ?></strong>
                        </p>

                        <p>
                            <em>Produit commandé: </em> <strong><?= $getAnOrder['purchased_product']; ?></strong>
                        </p>

                        <p>
                            <em>Quantité: </em> <strong><?= $getAnOrder['product_quantity']; ?></strong>
                        </p>

                        <p>
                            <em>Prix: </em> <strong><?= $getAnOrder['total_price']; ?>Fcfa</strong>
                        </p>

                        <p>
                            <em>Commandé le: </em> <strong><?= $getAnOrder['orderDate_fr']; ?></strong>
                        </p>
                    </div>
                </div>
            </div>

            <p class="link">
                <a href="orderConfirmation.php?order_id=<?= $order_id; ?>">Valider la commande</a>
            </p>
        </section>
    </body>
</html>