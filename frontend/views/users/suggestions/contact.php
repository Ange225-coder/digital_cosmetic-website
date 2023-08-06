<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aidez nous à nous améliorer</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/contact.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">

    </head>

    <body>

        <section>
            <article>
                <div class="text">
                    <h1>Dites comment nous pouvons nous améliorer</h1>

                    <p>
                        Faite nous des suggestions amélioratives, où contactez-nous pour plus d'informations sur un de nos produits
                    </p>
                </div>

                <div class="img">
                    <img src="../../../../public/pics/health.svg" alt="digital_cosmetics_contact">
                </div>
            </article>

            <article>
                <form method="POST" action="../../../../backend/router/router.php?action=setSuggestionCtrl">

                    <p class="error">
                        <?php if(isset($error_set_suggestion)): ?>
                            <?=  $error_set_suggestion; ?>
                        <?php endif; ?>
                    </p>


                    <div class="inputs-block">
                        <div>
                            <label for="full_name">
                                <input type="text" name="full_name" id="full_name" placeholder="Nom complet" required>
                            </label>
                        </div>

                        <div>
                            <label for="email">
                                <input type="email" name="email" id="email" placeholder="Email" required>
                            </label>
                        </div>

                        <div>
                            <label for="phone_number">
                                <input type="tel" name="phone_number" id="phone_number" placeholder="Numéro de téléphone" required>
                            </label>
                        </div>

                        <div class="message">
                            <label for="message">
                                <textarea name="message" id="message" placeholder="Message" maxlength="255" required></textarea>
                            </label>
                        </div>
                    </div>

                    <div class="btn">
                        <button type="submit">Envoyer le message</button>
                    </div>
                </form>
            </article>
        </section>

    </body>
</html>