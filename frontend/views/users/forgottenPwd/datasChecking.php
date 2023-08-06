<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Réinitialiser le mot de passe</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/emailChecking.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>

    <body>

        <section>
            <h1>Reinitialisation du mot de passe</h1>

            <span class="material-symbols-outlined person">person</span>

            <h2>Entrer l'email de la création de votre compte</h2>

            <form method="POST" action="../../../../backend/router/router.php?action=getEmailCtrl">

                <p class="error">
                    <?php if(isset($errorGetEmail)): ?>
                        <?= $errorGetEmail; ?>
                    <?php endif; ?>
                </p>

                <div class="emailForm">
                    <label for="email">
                        <input type="email" name="email" id="email" placeholder="Entrer votre email" required>
                    </label>
                </div>

                <div class="btn">
                    <button type="submit">Continuer</button>
                </div>
            </form>
        </section>

    </body>
</html>