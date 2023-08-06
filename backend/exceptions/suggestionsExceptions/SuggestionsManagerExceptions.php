<?php

    declare(strict_types = 1);

    namespace App\exceptions\suggestionsExceptions;

    use RuntimeException;

    class SuggestionsManagerExceptions extends RuntimeException
    {
        public static function errorPhoneNumberFormat(): string
        {
            return 'Le format de votre numéro mobil n\'est pas accepté sur ce site';
        }


        public static function errorFormatEmail(): string
        {
            return 'Entrez un email au format correct';
        }


        public static function errorFormatFullName(): string
        {
            return 'Le format de ce nom n\'est pas accepté sur ce site';
        }


        public static function errorAdminPass(): string
        {
            return 'Impossible de retirer le message, mot de passe incorrect';
        }


        public static function errorMissingMsgId(): string
        {
            return 'Entrer l\'identifiant du message à supprimer';
        }


        public static function errorAdminPassword(): string
        {
            return 'Impossible de supprimer les suggestions, mot de passe incorrect';
        }
    }