<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function getEmailCtrl(): void
    {
        $get_email = new UsersManager();

        $server_request = $_SERVER['REQUEST_METHOD'];

        if($server_request == 'POST') {

            $email = strip_tags($_POST['email']);

            $dataExists = false;

            foreach($get_email->getEmail() as $checkingEmail) {

                if($email === $checkingEmail['u_email']) {

                    $_SESSION['email'] = $email;

                    header('location: ../../../frontend/views/users/forgottenPwd/resetPwdForm.php');

                    $dataExists = true;
                }
           }

            if(!$dataExists) {
                throw new UsersManagerExceptions($email.UsersManagerExceptions::errorEmailNotExists());
            }
        }
    }