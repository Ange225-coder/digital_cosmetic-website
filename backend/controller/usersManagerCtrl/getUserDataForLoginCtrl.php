<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once($path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function getUserDataForLoginCtrl(): void
    {
        $user_data = new UsersManager();

        $server_request = $_SERVER['REQUEST_METHOD'];

        if($server_request == 'POST') {
            $email = strip_tags($_POST['email']);
            $password = $_POST['password'];

            $email_entered = $user_data->getUserDataForLogin($email);

            if($email_entered && password_verify($password, $email_entered['u_password'])) {
                $_SESSION['name'] = $email_entered['u_full-name'];
                $_SESSION['email'] = $email_entered['u_email'];
                $_SESSION['phone'] = $email_entered['u_number'];
                $_SESSION['id'] = $email_entered['id'];
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorWrongData().'('.$email.' / '.$password.')');
            }
        }
    }