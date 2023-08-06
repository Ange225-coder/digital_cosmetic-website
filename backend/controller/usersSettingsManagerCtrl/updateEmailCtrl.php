<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;
    use App\model\usersManager\UsersManager;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;

    function updateEmailCtrl(): void
    {
        $updateEmail = new UsersSettingsManager();
        $getEmail = new UsersManager();

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {

            $newEmail = strip_tags($_POST['new_email']);
            $user_id = $_SESSION['id'];

            if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $newEmail)) {
                foreach($getEmail->getUserData() as $emailChecking) {
                    if($newEmail === $emailChecking['u_email']) {
                        throw new UsersSettingsExceptions($newEmail.UsersSettingsExceptions::errorEmailAlreadyExist());
                    }
                }

                $updateEmail->updateEmail($newEmail, $user_id);

                //this message its display in login page
                $_SESSION['emailUpdating_done'] = 'Mise à jour de l\'email effectuée avec succèss. Reconnectez-vous pour prendre en compte la mise à jour';
            }
            else {
                throw new UsersSettingsExceptions(UsersSettingsExceptions::errorEmailFormat());
            }
        }
    }