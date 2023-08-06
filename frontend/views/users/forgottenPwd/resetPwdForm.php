<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nouveau mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/resetPwdForm.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>

    <body>

        <section>
            <h1>Reinitialisation du mot de passe</h1>

            <span class="material-symbols-outlined person">person</span>

            <form method="POST" action="../../../../backend/router/router.php?action=resetPwdCtrl">

                <p class="error">
                    <?php if(isset($errorResetPwd)): ?>
                        <?= $errorResetPwd; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="email">
                        <input type="email" name="email" id="email" value="<?= $email; ?>" readonly>
                        <span class="material-symbols-outlined verified_user_icon">verified_user</span>
                    </label>
                </div>


                <div class="newPwdForms">
                    <h2>Nouveau mot de passe</h2>

                    <div>
                        <label for="password">
                            <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" required>
                        </label>
                    </div>

                    <div>
                        <label for="confirm-pass">
                            <input type="password" name="confirm-pass" id="confirm-pass" placeholder="Répéter le mot de passe" required>
                        </label>
                    </div>
                </div>


                <div class="btn">
                    <button type="submit">Mise à jour du mot de passe</button>
                </div>
            </form>

            <p class="notice">
                <em>NB: Vous serez redirigé vers la page de connexion afin de prendre en compte les modifications</em>
            </p>
        </section>

    </body>
</html>