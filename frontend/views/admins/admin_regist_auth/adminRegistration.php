

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Longrich - Enregistrement administrateur</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/admin-registration.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <section>
            <div class="main-content">
                <h1>Administration | S'enregistrer</h1>

                <form method="POST" action="../../../../backend/router/router.php?action=setAdminCtrl">

                    <p class="error">
                        <?php if(isset($error_admin_registration)): ?>
                            <?= $error_admin_registration; ?>
                        <?php endif; ?>
                    </p>

                    <div class="input-block--grid">
                        <div>
                            <label for="username">Pseudonyme<span>*</span></label>
                            <input type="text" name="username" id="username" placeholder="Entrer un pseudonyme" required>
                        </div>

                        <div>
                            <label for="admin_email">Email<span>*</span></label>
                            <input type="email" name="admin_email" id="admin_email" placeholder="Entrez votre email" required>
                        </div>

                        <div>
                            <label for="password">Mot de passe <span>*</span></label>
                            <input type="password" name="password" id="password" placeholder="Entrer un mot de passe" required>
                        </div>
                    </div>

                    <div class="btn">
                        <button type="submit">S'enregistrer</button>
                    </div>
                </form>
            </div>

        </section>
    </body>
</html>