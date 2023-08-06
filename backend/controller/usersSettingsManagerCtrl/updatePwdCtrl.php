<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\usersManager\UsersSettingsManager;
    use App\exceptions\usersManagerExceptions\UsersSettingsExceptions;

    function updatePwdCtrl(): void
    {
        $updatePass = new UsersSettingsManager();

        $request = $_SERVER['REQUEST_METHOD'];
        $id = $_SESSION['id'];

        if($request == 'POST') {
            $current_pass = $_POST['current_pass'];
            $new_pass = $_POST['new_pass'];
            $confirm_NewPass = $_POST['confirm_newPass'];

            $pass_hashed = password_hash($new_pass, PASSWORD_DEFAULT);

            $user_id = $updatePass->getUserId($id);

            if($user_id && password_verify($current_pass, $user_id['u_password'])) {
                if(preg_match('#^[a-zA-Z0-9/_@$. ]{6,16}$#', $new_pass)) {
                    if($new_pass !== $confirm_NewPass) {
                        throw new UsersSettingsExceptions(UsersSettingsExceptions::errorSamePwd().'('.$new_pass.' / '.$confirm_NewPass.')');
                    }
                    else {
                        $updatePass->updatePwd($pass_hashed, $id);

                        $_SESSION['pwdUpdating_done'] = 'Mise à jour du mot de passe effectué avec success. Reconnectez-vous pour prendre en compte la mise à jour';
                    }
                }
                else {
                    throw new UsersSettingsExceptions(UsersSettingsExceptions::errorPwdFormat());
                }
            }
            else {
                throw new UsersSettingsExceptions(UsersSettingsExceptions::errorWrongCurrentPwd());
            }
        }
    }