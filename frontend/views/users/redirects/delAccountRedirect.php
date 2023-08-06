<?php
    $title = 'Suppression du compte effectué';

    ob_start();
?>

    <div>
        <h1>Votre compte viens d'être supprimé</h1>

        <h2>
            Vous pouvez à nouveau vous <a href="../regist_auth/registration.php">inscrire</a>
        </h2>

        <p>
            <a href="../../../../index.php">Accueil</a>
        </p>
    </div>

<?php
    $content = ob_get_clean();

    require_once('../../../templates/layout/layout.php');
?>


