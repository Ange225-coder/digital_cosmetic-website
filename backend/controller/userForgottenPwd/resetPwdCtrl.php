<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersManagerExceptions;

    function resetPwdCtrl(): void
    {
        $reset_pwd = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {
            $password = $_POST['password'];
            $confirm_pass = $_POST['confirm-pass'];
            $email = $_SESSION['email'];

            if(preg_match('#^[a-zA-Z0-9/_@$. ]{6,16}$#', $password)) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                if($password !== $confirm_pass) {
                    throw new UsersManagerExceptions(UsersManagerExceptions::errorDifferentPwd().' ('.$password.' / '.$confirm_pass.')');
                }
                else {
                    $reset_pwd->resetPwd($password_hashed, $email);
                }
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorPwdIncorrectFormat());
            }
        }
    }