<?php
    require_once('../../../../backend/controller/suggestionsManagerCtrl/getSuggestionsCtrl.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Administration | suggestions</title>
        <link rel="stylesheet" type="text/css" href="../../../../public/css-prefixed/message.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ysabeau+Office:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
            <div class="header">
                <h2>Messages (<?= count(getSuggestionsCtrl()); ?>)</h2>

                <?php if(count(getSuggestionsCtrl()) >= 2): ?>
                    <p>
                        <a href="delAllMessage.php" title="Supprimer toutes les suggestions">
                            <span class="fa-solid fa-trash fa-beat-fade"></span>
                        </a>
                    </p>
                <?php endif; ?>
            </div>


            <?php if(count(getSuggestionsCtrl()) == 0): ?>
                <article class="no-suggestion">
                    <div>
                        <img src="../../../../public/pics/ad-msg.svg" alt="digital_cosmetics">
                    </div>

                    <h1>Vous n'avez aucune suggestions</h1>
                </article>
            <?php endif; ?>


            <?php if(count(getSuggestionsCtrl()) >= 1): ?>

                <article class="suggestions">
                    <?php foreach(getSuggestionsCtrl() as $suggestion): ?>
                        <div class="suggestions__content">
                            <p>
                                <strong>Nom : </strong> <?= $suggestion['s_full_name']; ?>
                            </p>

                            <p>
                                <strong>Email : </strong> <?= $suggestion['s_email']; ?>
                            </p>

                            <p>
                                <strong>Contact : </strong> <?= $suggestion['s_phone']; ?>
                            </p>

                            <p class="block-msg">
                                <strong>Message : </strong> <?= $suggestion['s_message']; ?>
                            </p>

                            <p>
                                <em>Publié le : </em> <?= $suggestion['suggestions_dateFr'] ?>
                            </p>


                            <a href="delMessage.php?msg_id=<?= $suggestion['id']; ?>" class="link">
                                <div>
                                    <span class="bi bi-trash3"></span>
                                    <span>Retirer cette suggestion</span>
                                </div>
                            </a>

                        </div>


                    <?php endforeach; ?>
                </article>
            <?php endif; ?>


        </section>
    </body>
</html>