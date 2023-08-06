<?php

    declare(strict_types = 1);

    namespace App\Exceptions\AdminManageExceptions;

    use RuntimeException;

    class AdminManageExceptions extends RuntimeException
    {
        public static function adminUsernameAlreadyExist(): string
        {
            return 'Cet administrateur existe déjà en base';
        }


        public static function wrongUsernameRegistrationFormat(): string
        {
            return 'Le format du pseudonyme est incorrect';
        }


        public static function adminEmailAlreadyExist(): string
        {
            return 'Cet email est déjà utilisé par un autre administrateur';
        }


        public static function wrongEmailRegistrationFormat(): string
        {
            return 'Entrez un email au format correct';
        }


        public static function wrongAdminPassFormat(): string
        {
            return 'Le format du mot de passe est incorrect';
        }


        public static function errorEmptyFields(): string
        {
            return 'Les champs ne doivent pas resté vide';
        }


        public static function invalidAdmin(): string
        {
            return 'Administrateur invalid';
        }
    }