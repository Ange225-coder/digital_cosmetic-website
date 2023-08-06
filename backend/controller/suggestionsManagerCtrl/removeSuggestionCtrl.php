<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\suggestionsManager\SuggestionsManager;
    use App\model\adminManager\AdminManage;
    use App\exceptions\suggestionsExceptions\SuggestionsManagerExceptions;

    function removeSuggestionCtrl(): void
    {
        $removeSuggestion = new SuggestionsManager();
        $get_admin_username = new AdminManage();

        $request = $_SERVER['REQUEST_METHOD'];

        if(isset($_GET['msg_id']) && $_GET['msg_id'] > 0 && is_numeric($_GET['msg_id'])) {
            $id = $_GET['msg_id'];
            $admin_logged_in = $_SESSION['username'];

            if($request == 'POST') {
                $password = $_POST['password'];
                $username = $get_admin_username->getAdminForConnexion($admin_logged_in);

                if($username && password_verify($password, $username['a_password'])) {

                    $removeSuggestion->removeSuggestion($id);
                }
                else {
                    throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorAdminPass());
                }
            }
        }
        else {
            throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorMissingMsgId());
        }
    }