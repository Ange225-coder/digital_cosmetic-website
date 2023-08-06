<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\suggestionsManager\SuggestionsManager;
    use App\model\adminManager\AdminManage;
    use App\exceptions\suggestionsExceptions\SuggestionsManagerExceptions;

    function removeAllSuggestionCtrl(): void
    {
        $removing_suggestion = new SuggestionsManager();
        $get_admin_username = new AdminManage();

        $request = $_SERVER['REQUEST_METHOD'];

        $admin_logged_in = $_SESSION['username'];

        if($request == 'POST') {
            $password = $_POST['password'];
            $username = $get_admin_username->getAdminForConnexion($admin_logged_in);

            if($username && password_verify($password, $username['a_password'])) {

                $removing_suggestion->removeAllSuggestions();
            }
            else {
                throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorAdminPassword());
            }
        }
    }