<?php

    declare(strict_types = 1);

    namespace App\exceptions\productManagerExceptions;

    use RuntimeException;

    class ProductInCartManagerExceptions extends RuntimeException
    {
        public static function errorQuantity(): string
        {
            return 'Commande impossible entrer une quantité inférieur ou égale à la quantité restante de produit';
        }


        public static function errorMissingProductId(): string
        {
            return 'Entrer l\'identifiant du produit pour continuer';
        }


        public static function errorWrongAdminPass(): string
        {
            return 'Le mot de passe est incorrect ';
        }


        public static function errorMissingOrderId(): string
        {
            return 'Entrer l\'identifiant de la commande pour continuer';
        }
    }