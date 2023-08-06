<?php
    require_once('../../../../backend/controller/productsManagerCtrl/sortProductsCtrl.php');
    require_once('../../../../backend/controller/usersManagerCtrl/getOrderInProcessCtrl.php');
    require_once('../../../../backend/controller/paginationsCtrl/paginationManagerCtrl.php');

    session_start();

    $category = $_SESSION['category'];

    if(isset($_SESSION)) {
        $name = $_SESSION['name'] ?? '';
        $email = $_SESSION['email'] ?? '';
    }
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Catégorie | <?= $category; ?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/products-sorting.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <nav>

            <div class="nav-content">

                <div class="logo">
                    <a href="../../../../index.php">
                        <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                    </a>
                </div>

                <div class="input">
                    <label for="search">
                        <input type="search" id="search" placeholder="Rechercher un produit" onclick="window.location.href='../searches/productsSearches.php';">
                        <i class="bi bi-search"></i>
                    </label>
                </div>

                <div class="search-icon">
                    <span class="bi bi-search" onclick="window.location.href='../searches/productsSearches.php';"></span>
                </div>

                <div class="user">
                    <details>
                        <summary>
                                <span>
                                    <?php if(!$email || !$name): ?>

                                        <span class="login">
                                            <i class="bi bi-person --margR"></i> <span>Se connecter</span>
                                        </span>

                                    <?php else: ?>

                                        <span class="logged">
                                            <span class="bi bi-person-check --fontS"></span><span> <?= $name; ?></span>
                                        </span>

                                    <?php endif; ?>
                                    <i class="bi bi-chevron-down --margL"></i>
                                </span>

                            <i class="bi bi-list" title="menu" id="menuHamburger"></i>
                        </summary>

                        <div>
                            <?php if(!$email): ?>
                                <a href="../../../../frontend/views/users/regist_auth/login.php" class="login">Se connecter</a>

                                <hr class="login-line">
                            <?php endif; ?>

                            <?php if($email): ?>
                                <a href="../../../../frontend/views/users/settings/userSettings.php" class="logged"><i class="bi bi-gear-wide"></i> <span>Paramètres</span></a>
                                <a href="../../../../frontend/views/users/products/cart.php" class="logged cart"><i class="bi bi-cart3"></i><sup><?= count(getOrderInProcessCtrl()); ?></sup> <span>Panier</span></a>
                                <a href="../../../../frontend/views/users/products/orderProcessed.php" class="logged"><i class="bi bi-box-seam"></i> <span>Mes commandes</span></a>
                            <?php endif; ?>

                            <a href="../../../../frontend/views/users/suggestions/contact.php" class="contact"><i class="fa-regular fa-address-book"></i> <span>Contact</span></a>

                            <?php if($email): ?>
                                <hr class="logged-line">

                                <a href="../../../../backend/logout/logout.php" class="--center">Déconnexion</a>
                            <?php endif; ?>
                        </div>
                    </details>
                </div>
            </div>

        </nav>


        <section>
            <h1>
                <a href="#" onclick="window.history.back();" title="retour">
                    <span class="bi bi-arrow-left"></span>
                </a>

                Catégorie: <?= $category; ?>
            </h1>

            <hr class="--line-top">

            <div class="product-block">
                <?php foreach(sortProductsCtrl() as $sorting): ?>

                    <div class="product">
                        <div class="product-img">
                            <?php if(!empty($sorting['p_img'])): ?>
                                <?php $imgData = base64_encode($sorting['p_img']); ?>
                                <?php $imgType = mime_content_type('data://image/jpeg;base64,'.$imgData); ?>
                                <img src="data:<?= $imgType; ?>;base64,<?= $imgData ?>" alt="<?= $sorting['p_name'] ?>" width="200">
                            <?php endif; ?>
                        </div>

                        <div class="product-description">
                            <p class="name"><?= $sorting['p_name']; ?></p>

                            <p class="price"><?= $sorting['p_price']; ?> Fcfa</p>

                            <h2>
                                Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                            </h2>

                            <p class="link">
                                <a href="putAproductInCart.php?product_id=<?= $sorting['product_id']; ?>">Ajouter au panier</a>
                            </p>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <hr class="--line-bott">

            <div class="pagination">
                <?php for($i=1; $i<=getLinkForSortingPagination(); $i++): ?>
                    <?php if(getCurrentPage() != $i): ?>
                        <div>
                            <p>
                                <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                            </p>
                        </div>

                    <?php else: ?>
                        <p>
                            <a><?= $i; ?></a>
                        </p>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </section>



        <footer>
            <div>
                <p>
                     <span class="copyright">Digital Cosmetics - Tous droits réservés</span>  <span> <a href="https://api.whatsapp.com/send?phone=2250160318959" class="whats" target="_blank"><i class="bi bi-whatsapp"></i></a></span>
                </p>
            </div>
        </footer>
    </body>
</html>