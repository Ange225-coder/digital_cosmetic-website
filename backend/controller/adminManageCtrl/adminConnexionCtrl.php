<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\Model\adminManager\AdminManage;
    use App\Exceptions\AdminManageExceptions\AdminManageExceptions;

    function adminConnexionCtrl(): void
    {
        $get_admin_parameters = new AdminManage();

        $auth_username = strip_tags($_POST['auth_name'] ?? '');

        if(isset($_POST['auth_name']) && isset($_POST['auth_pwd'])) {
            $auth_name = $get_admin_parameters->getAdminForConnexion($auth_username);
            $auth_pwd = $_POST['auth_pwd'];

            if($auth_name && password_verify($auth_pwd, $auth_name['a_password'])) {

                $_SESSION['username'] = $auth_name['a_username'];
            }
            else {
                throw new AdminManageExceptions(AdminManageExceptions::invalidAdmin());
            }
        }
    }