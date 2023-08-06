<?php

    declare(strict_types = 1);

    namespace App\exceptions\usersManagerExceptions;

    use RuntimeException;

    class UsersSettingsExceptions extends RuntimeException
    {
        public static function errorEmailAlreadyExist(): string
        {
            return ' existe déjà, choisissez un autre';
        }


        public static function errorEmailFormat(): string
        {
            return 'Le format de cet email n\'est pas prise en compte sur ce site';
        }


        public static function errorSamePwd(): string
        {
            return 'Les mots de passe ne sont pas identiques ';
        }


        public static function errorPwdFormat(): string
        {
            return 'Le format du mot de passe n\'est pas accepté sur ce site';
        }


        public static function errorWrongCurrentPwd(): string
        {
            return 'Le mot de pass actuel ne correspond pas';
        }


        public static function errorPwd(): string
        {
            return 'Mot de passe incorrect, impossible de supprimer le compte';
        }
    }