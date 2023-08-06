<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $email = $_SESSION['email'] ?? '';
    $name = $_SESSION['name'] ?? '';

    if(!$name || !$email) {
        header('location: ../regist_auth/login.php');
    }

    require_once(__DIR__.'/../../../../backend/controller/usersSettingsManagerCtrl/getRegistrationDateCtrl.php');

    $gettingDate = getRegistrationDateCtrl($email);
    //$registrationDateFr = date('%d %B, %Y', $gettingDate['registrationDateFr']);


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Digital Cosmetics - Paramètres utilisateur</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/usersSettings.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <header>
            <nav>
                <div class="logo">
                    <img src="../../../../public/pics/logo/dc.png" alt="digital_cosmetics_logo">
                </div>

                <div>
                    <p>
                        <span class="material-symbols-outlined fingerprint">fingerprint</span> <span><?= $name; ?></span>
                    </p>
                </div>
            </nav>
        </header>

        <div class="link">
            <a href="#" onclick="window.location.reload();">Paramètres utilisateurs</a>
        </div>

        <section class="user">

            <div class="user-content">
                <h1 class="material-symbols-outlined user-icon">fingerprint</h1>

                <div>
                    <h2 class="name"><?= $name; ?></h2>

                    <div class="user-info">
                        <p>
                            <span class="bi bi-person-fill"></span> <span>user</span>
                        </p>

                        <p>
                            <span class="bi bi-clock"></span>

                            <span>
                                inscrit le <?= $gettingDate['registrationDateFr']; ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

        </section>


            
        <section class="forms-container">

            <div class="emailForm">
                <h2>Mettez à jour votre email</h2>

                <form method="POST" action="../../../../backend/router/router.php?action=updateEmailCtrl">

                    <p class="error">
                        <?php if(isset($error_email_update)): ?>
                            <?= $error_email_update; ?>
                        <?php endif; ?>
                    </p>

                    <div>
                        <label for="current_email">
                            <input type="email" name="current_email" id="current_email" value="<?= $email; ?>" readonly>
                        </label>
                    </div>

                    <div>
                        <label for="new_email">
                            <input type="email" name="new_email" id="new_email" placeholder="Nouvel email" required>
                        </label>
                    </div>

                    <div class="btn">
                        <button type="submit">Mettre à jour l'email</button>
                    </div>
                </form>
            </div>



            <div class="pwdForm">
                <h2>Mettre à jour le mot de passe</h2>

                <form method="POST" action="../../../../backend/router/router.php?action=updatePwdCtrl">

                    <p>
                        <?php if(isset($error_pwd_update)): ?>
                            <?= $error_pwd_update; ?>
                        <?php endif; ?>
                    </p>

                    <div>
                        <label for="current_pass">
                            <input type="password" name="current_pass" id="current_pass" placeholder="Mot de passe actuel" required>
                        </label>
                    </div>

                    <div>
                        <label for="new_pass">
                            <input type="password" name="new_pass" id="new_pass" placeholder="Nouveau mot de passe" required>
                        </label>
                    </div>

                    <div>
                        <label>
                            <input type="password" name="confirm_newPass" id="confirm_newPass" placeholder="Confirmé le nouveau mot de passe" required>
                        </label>
                    </div>

                    <div class="btn">
                        <button type="submit">Mettre à jour le mot de passe</button>
                    </div>
                </form>
            </div>


            <div class="deletion">

                <h1>Supprimer le compte utilisateur <em><?= $name; ?></em></h1>

                <h2>Vous ne pouvez pas annuler cette action</h2>

                <p>
                    <a href="../../../../frontend/views/users/settings/delAccountForm.php">Supprimer le compte</a>
                </p>
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