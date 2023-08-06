<?php
    ob_start();

    session_start();

    session_unset();

    session_destroy();

    session_regenerate_id(true);

    header('location: ../../index.php');
    exit();