<?php

    declare(strict_types = 1);

    namespace App\exceptions\usersManagerExceptions;

    use RuntimeException;

    class UsersManagerExceptions extends RuntimeException
    {


        public static function errorFormatFullName(): string
        {
            return 'Format incorrect (Jhon Doe)';
        }


        public static function errorFormatEmail(): string
        {
            return 'Ce format d\'email n\'est pas accepté sur ce site';
        }


        public static function errorEmailAlreadyExist(): string
        {
            return ' existe déjà en base';
        }


        public static function errorFullNameAlreadyExist(): string
        {
            return ' exist déjà en base';
        }


        public static function errorFormatPhoneNumber(): string
        {
            return 'Format de numéro incorrect Ex: 01 02 03 04 05';
        }


        public static function errorDifferentPwd(): string
        {
            return 'Les mots de passe ne correspondent pas';
        }


        public static function errorPwdIncorrectFormat(): string
        {
            return 'Le format pour le mot de passe est incorrect';
        }


        public static function errorWrongData(): string
        {
            return 'Données invalides ';
        }


        public static function errorMissingUserSession(): string
        {
            return 'Impossible de voir les commandes session inexistante';
        }


        /** using in getEmailCtrl for forgottenPwd */

        public static function errorEmailNotExists(): string
        {
            return ' n\'existe pas en base';
        }

        public static function errorLocation(): string
        {
            return 'Entrer une localité correct';
        }
    }