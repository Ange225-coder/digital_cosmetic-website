<?php
    if(!isset($_SESSION)) {
        session_start();
    }

    $emailUpdatingDone = $_SESSION['emailUpdating_done'] ?? '';
    $passwordUpdatingDone = $_SESSION['pwdUpdating_done'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Longrich - connexion</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/user-login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

            <p class="success-msg">
                <?php if($emailUpdatingDone): ?>
                    <?= $emailUpdatingDone; ?>
                    <?php unset($emailUpdatingDone);
                        session_destroy();
                    ?>

                <?php elseif($passwordUpdatingDone): ?>
                    <?= $passwordUpdatingDone; ?>
                    <?php unset($passwordUpdatingDone);
                        session_destroy();
                    ?>

                <?php endif; ?>
            </p>

        <section>
            <h1>Connexion</h1>

            <h2>Vous ne possédez pas de compte? <a href="../../../../frontend/views/users/regist_auth/registration.php">Inscrivez-vous</a></h2>

            <form method="POST" action="../../../../backend/router/router.php?action=getUserDataForLoginCtrl">

                <p class="error">
                    <?php if(isset($error_user_login)): ?>
                        <?= $error_user_login; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="email">
                        <input type="email" name="email" id="email" placeholder="E-mail" required>
                        <i class="bi bi-person"></i>
                    </label>

                    <hr >
                </div>


                <div class="pwdForm">
                    <label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                        <i class="bi bi-lock"></i>
                    </label>

                    <hr >
                </div>



                <p class="forgottenPwd">
                    <a href="../../../../frontend/views/users/forgottenPwd/datasChecking.php">Mot de passe oublié</a>
                </p>

                <div class="btn">
                    <button type="submit">Se connecter</button>
                </div>

            </form>
        </section>

    </body>
</html>