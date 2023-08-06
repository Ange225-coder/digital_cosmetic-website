<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Longrich - authentification administrateur</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/admin-login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <section>
            <div class="main-content">
                <h1>Administration | Se connecter</h1>

                <form method="POST" action="../../../../backend/router/router.php?action=adminConnexionCtrl">

                    <p class="error">
                        <?php if(isset($error_admin_login)): ?>
                            <?= $error_admin_login; ?>
                        <?php endif; ?>
                    </p>

                    <div class="fields-block">
                        <div>
                            <label for="auth_name">
                                <input type="text" name="auth_name" id="auth_name" placeholder="Identifiant administrateur" required>
                            </label>
                        </div>

                        <div>
                            <label for="auth_pwd">
                                <input type="password" name="auth_pwd" id="auth_pwd" placeholder="Mot de passe administrateur" required>
                            </label>
                        </div>
                    </div>

                    <div class="btn">
                        <button type="submit">S'authentifier</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>