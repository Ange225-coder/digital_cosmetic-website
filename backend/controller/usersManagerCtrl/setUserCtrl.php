<?php

    declare(strict_types = 1);

    require_once(__DIR__.'/../../../autoload/autoload.php');

    use App\model\UsersManager\UsersManager;
    use App\Exceptions\usersManagerExceptions\UsersManagerExceptions;

    function setUserCtrl(): void
    {
        $set_new_user = new UsersManager();

        $server_request = $_SERVER['REQUEST_METHOD'];

        if($server_request == 'POST') {
            $full_name = strip_tags($_POST['full-name']);
            $email = strip_tags($_POST['email']);
            $phone = strip_tags($_POST['phone-number']);
            $day = $_POST['day'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $password = $_POST['password'];
            $confirm_pass = $_POST['confirm-pass'];
            $pass_hashed = password_hash($password, PASSWORD_DEFAULT);

            if(preg_match('#^[a-zA-Z ]{4,}$#', $full_name)) {
                foreach($set_new_user->getUserData() as $fullNameVerify) {
                    if($full_name === $fullNameVerify['u_full-name']) {
                        throw new UsersManagerExceptions($full_name.UsersManagerExceptions::errorFullNameAlreadyExist());
                    }
                }
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorFormatFullName());
            }


            if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
                foreach($set_new_user->getUserData() as $emailVerify) {
                    if($email === $emailVerify['u_email']) {
                        throw new UsersManagerExceptions($email.UsersManagerExceptions::errorEmailAlreadyExist());
                    }
                }
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorFormatEmail());
            }


            if(preg_match('#^0[1|5|7]([- ]?[0-9]{2}){4}$#', $phone)) {

                if(preg_match('#^[a-zA-Z0-9/_@$. ]{6,16}$#', $password)) {
                    if($password !== $confirm_pass) {
                        throw new UsersManagerExceptions(UsersManagerExceptions::errorDifferentPwd());
                    }
                    else {
                        $set_new_user->setUser($full_name, $email, $phone, $day, $month, $year, $pass_hashed);

                        $_SESSION['name'] = $full_name;
                        $_SESSION['email'] = $email;
                        $_SESSION['phone'] = $phone;

                        //$_SESSION['messageSendByLoggedUser'] = 'Message envoyé' ?? '';

                        /** loops for get user's id during registration */
                        foreach($set_new_user->getUserData() as $getId) {
                            $_SESSION['id'] = $getId['id'];
                        }
                    }
                }
                else {
                    throw new UsersManagerExceptions(UsersManagerExceptions::errorPwdIncorrectFormat());
                }
            }
            else {
                throw new UsersManagerExceptions(UsersManagerExceptions::errorFormatPhoneNumber());
            }
        }
    }