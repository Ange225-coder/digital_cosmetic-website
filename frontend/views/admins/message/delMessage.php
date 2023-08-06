<?php
    $msg_id = $_GET['msg_id'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supprimer une suggestion</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/delMessage.css">
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

                <div class="logout">
                    <a href="../../../../backend/logout/logout.php">Déconnexion</a>
                </div>
            </div>
        </nav>


        <section>
            <div class="main-content">

                <div class="logo-block">
                    <p class="img">
                        <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics">
                    </p>

                    <h1>
                        Digital <span><i class="fa-brands fa-canadian-maple-leaf"></i>Cosmetics</span>
                    </h1>
                </div>

                <div class="text-block">
                    <h2>Administration</h2>

                    <p>Entrez votre mot de passe pour continuer</p>
                </div>

                <form method="post" action="../../../../backend/router/router.php?action=removeSuggestionCtrl&amp;msg_id=<?= $msg_id; ?>">

                    <p class="error">
                        <?php if(isset($error_delete_suggestion)): ?>
                            <?= $error_delete_suggestion ?>
                        <?php endif; ?>
                    </p>

                    <div class="input-block--grid">
                        <div>
                            <label for="password">
                                <input type="password" name="password" id="password" placeholder="Mot de passe administrateur" required>
                            </label>
                        </div>

                        <div>
                            <button type="submit">Supprimer la suggestion</button>
                        </div>
                    </div>
                </form>

                <p class="notice">
                    <em>NB: Vous serez rediriger vers la page d'accueil apres suppression</em>
                </p>
            </div>
        </section>
    </body>
</html>