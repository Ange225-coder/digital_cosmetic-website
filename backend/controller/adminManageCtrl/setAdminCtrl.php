<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\Model\adminManager\AdminManage;
    use App\Exceptions\AdminManageExceptions\AdminManageExceptions;

    function setAdminCtrl(): void
    {
        $set_new_admin = new AdminManage();

        if(isset($_POST['username']) && isset($_POST['admin_email']) && isset($_POST['password'])) {
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['admin_email']);
            $password = $_POST['password'];

            /**
             * regex for admin username and
             * check for if he already exists
             */
            if(preg_match('#^(admin_)+([a-zA-Z0-9.@])+$#', $username)) {
                foreach($set_new_admin->getAllAdminParameters() as $checkForAdminUsername) {
                    if($username === $checkForAdminUsername['a_username']) {
                        throw new AdminManageExceptions(AdminManageExceptions::adminUsernameAlreadyExist());
                    }
                }
            }
            else {
                throw new AdminManageExceptions(AdminManageExceptions::wrongUsernameRegistrationFormat());
            }


            /**
             * regex for admin email and check if
             * email already exists in db
             */
            if(preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {
                foreach($set_new_admin->getAllAdminParameters() as $checkForAdminEmail) {
                    if($email === $checkForAdminEmail['a_email']) {
                        throw new AdminManageExceptions(AdminManageExceptions::adminEmailAlreadyExist());
                    }
                }
            }
            else {
                throw new AdminManageExceptions(AdminManageExceptions::wrongEmailRegistrationFormat());
            }


            /**
             * regex for admin  password
             */
            if(preg_match('#^(admin1)+[a-zA-Z0-9/_@$. ]{6,16}$#', $password)) {
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);

                $set_new_admin->setAdmin($username, $email, $password_hashed);

                $_SESSION['username'] = $username;
            }
            else {
                throw new AdminManageExceptions(AdminManageExceptions::wrongAdminPassFormat());
            }
        }
        else {
            throw new AdminManageExceptions(AdminManageExceptions::errorEmptyFields());
        }
    }