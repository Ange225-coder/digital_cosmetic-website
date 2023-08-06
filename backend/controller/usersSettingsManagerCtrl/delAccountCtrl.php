<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;

    function delAccountCtrl(): void
    {
        $deletion = new UsersSettingsManager();

        $request = $_SERVER['REQUEST_METHOD'];

        $id = $_SESSION['id'];

        $user_id = $deletion->getUserId($id);

        if($request == 'POST') {
            $password = $_POST['password'];

            if($user_id && password_verify($password, $user_id['u_password'])) {

                $deletion->delAccount($id);

                session_destroy();
            }
            else {
                throw new UsersSettingsExceptions(UsersSettingsExceptions::errorPwd());
            }
        }
    }