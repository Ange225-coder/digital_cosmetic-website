<?php

    if(!isset($_SESSION)) {
        session_start();

        if(!isset($_SESSION['username'])) {
            header('location: ../../admin_regist_auth/adminLogin.php');
        }
    }

    $username = $_SESSION['username'] ?? '';
    $product_id = $_GET['product_id'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppression d'article</title>
        <link rel="stylesheet" type="text/css" href="../../../../../public/css-prefixed/delProduct.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7e51403c1f.js" crossorigin="anonymous"></script>
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
            <div class="main-content">

                <div class="logo-block">
                    <p class="img">
                        <img src="../../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                    </p>

                    <h1>
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </h1>
                </div>

                <div class="text-block">
                    <h2>Administration</h2>

                    <p>Entrez votre mot de passe pour continuer</p>
                </div>

                <form method="POST" action="../../../../../backend/router/router.php?action=deleteProductCtrl&amp;product_id=<?= $product_id ?>">

                    <p class="error">
                        <?php if(isset($error_product_deletion)): ?>
                            <?= $error_product_deletion; ?>
                        <?php endif; ?>
                    </p>

                    <div class="input-block--grid">
                        <div>
                            <label for="admin_pass">
                                <input type="password" name="admin_pass" id="admin_pass" placeholder="Mot de passe administrateur" required>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Retirer l'article</button>
                        </div>
                    </div>
                </form>

                <p class="notice">
                    <em>Vous serez automatiquement redirigé vers l'accueil après suppression</em>
                </p>
            </div>

        </section>

    </body>
</html>