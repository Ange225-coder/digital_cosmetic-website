<?php session_start();
    if(!isset($_SESSION['username'])) {
        header('location: ../../admins/admin_regist_auth/adminLogin.php');
    }

    $user_deletion_done = $_SESSION['deletion_done'] ?? '';
    $product_modification_done = $_SESSION['product_modify_done'] ?? '';
    $order_processed_success = $_SESSION['order_processed_success'] ?? '';

    require_once('../../../../backend/controller/adminManagementCtrl/displayOrderInAdminHomepage.php');
    require_once('../../../../backend/controller/suggestionsManagerCtrl/getSuggestionsCtrl.php');
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenue <?= $_SESSION['username']; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/adminHomePage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <div>
            <p class="success-msg">
                <?php if(isset($user_deletion_done)): ?>
                    <?= $user_deletion_done; ?>
                    <?php unset($_SESSION['deletion_done']); ?>
                <?php endif; ?>
            </p>

            <p class="success-msg">
                <?php if(isset($product_modification_done)): ?>
                    <?= $product_modification_done; ?>
                    <?php unset($_SESSION['product_modify_done']); ?>
                <?php endif; ?>
            </p>

            <p class="success-msg">
                <?php if(isset($order_processed_success)): ?>
                    <?= $order_processed_success; ?>
                    <?php unset($_SESSION['order_processed_success']); ?>
                <?php endif; ?>
            </p>
        </div>


        <section>
            <div class="logo">
                <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics_logo">
            </div>

            <div class="administration">

                <div class="administration-content">
                    <div class="heading-block">
                        <h1>
                            DIGITAL <span><i class="fa-brands fa-canadian-maple-leaf"></i>COSMETICS</span>
                        </h1>

                        <h2>Administration</h2>
                    </div>

                    <div class="links">
                        <a href="../manageByAdmins/products/addProduct.php" title="Ajouter un produit" class="add-product --movBott">
                            <span class="bi bi-database-add"></span> <span class="links--textSize">Ajouter un produit</span>
                        </a>

                        <a href="../manageByAdmins/products/productsList.php" title="Liste des produits" class="product-list --movBott">
                            <span class="bi bi-card-list"></span> <span class="links--textSize">Liste des produits</span>
                        </a>

                        <a href="../manageByAdmins/products/productInProcess.php" title="Commande en cours" class="orders --movBott">
                            <span class="bi bi-bell"></span><sup><?= count(displayOrdersInAdminHomepage()); ?></sup> <span class="links--textSize">Commande en cours</span>
                        </a>

                        <a href="../message/messages.php" title="Suggestions" class="message --movBott">
                            <span class="bi bi-envelope"></span><sup><?= count(getSuggestionsCtrl()); ?></sup> <span class="links--textSize">Suggestions</span>
                        </a>

                        <a href="../../../../backend/logout/logout.php" title="Déconnexion" class="logout">
                            <span class="bi bi-box-arrow-right"></span> <span class="links--textSize">Déconnexion</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>