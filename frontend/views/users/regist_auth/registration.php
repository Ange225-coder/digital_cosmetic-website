<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Longrich - connexion</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/user-registration.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
    </head>

    <body>

        <section>
            <h1>Inscription</h1>

            <form method="POST" action="../../../../backend/router/router.php?action=setUserCtrl">

                <p class="error">
                    <?php if(isset($error_set_user)): ?>
                        <?= $error_set_user; ?>
                    <?php endif; ?>
                </p>

                <div class="inputs-block">
                    <div class="inputs-block--size">
                        <label for="full-name" class="required">Nom complet</label>
                        <input type="text" name="full-name" id="full-name" placeholder="Nom complet" required>
                    </div>

                    <div class="inputs-block--size">
                        <label for="email" class="required">Email</label>
                        <input type="email" name="email" id="email" placeholder="E-mail" required>
                    </div>

                    <div class="inputs-block--size">
                        <label for="phone-number" class="required">Numéro de téléphone</label>
                        <input type="text" name="phone-number" id="phone-number" placeholder="Contact téléphonique" required>
                    </div>

                    <div class="datetime inputs-block--size">

                        <div class="day">
                            <label for="day" class="required">Jour</label>
                            <input type="number" name="day" id="day" placeholder="Jour" min="1" max="31" required>
                        </div>

                        <div class="month">
                            <label for="month" class="required">Mois</label>
                            <script src="../../../../vendor/updateMaxDay.js"></script>
                            <select id="month" name="month" onchange="updateMaxDay()" title="Mois de naissance" required>
                                <option value="Janvier">Janvier</option>
                                <option value="Février">Février</option>
                                <option value="Mars">Mars</option>
                                <option value="Avril">Avril</option>
                                <option value="Mai">Mai</option>
                                <option value="Juin">Juin</option>
                                <option value="Juillet">Juillet</option>
                                <option value="Août">Août</option>
                                <option value="Septembre">Septembre</option>
                                <option value="Octobre">Octobre</option>
                                <option value="Novembre">Novembre</option>
                                <option value="Décembre">Décembre</option>
                            </select>
                        </div>

                        <div class="year">
                            <label for="year" class="required">Année</label>
                            <input type="number" name="year" id="year" min="1920" max="2023" placeholder="Année" required>
                        </div>
                    </div>


                    <div class="pwdForms inputs-block--size">
                        <div>
                            <label for="password" class="required">Mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                        </div>

                        <div>
                            <label for="confirm-pass" class="required">Répéter le mot de passe</label>
                            <input type="password" name="confirm-pass" id="confirm-pass" placeholder="Répéter votre mot de passe" required>
                        </div>
                    </div>

                </div>


                <div class="btn">
                    <button type="submit">S'inscrire</button>
                </div>
            </form>
        </section>

    </body>
</html>