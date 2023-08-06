<?php

    declare(strict_types = 1);

    namespace App\exceptions\adminManagementExceptions;

    use RuntimeException;

    class ProductsExceptions extends RuntimeException
    {
        public static function errorQuantity(): string
        {
            return 'Erreur: vérifier la quantité entré';
        }


        public static function errorPrice(): string
        {
            return 'Erreur: vérifier le prix entré';
        }


        public static function errorProductImgSize(): string
        {
            return 'La taille de l\'image ne doit pas dépasser 2Mo';
        }


        public static function errorImgExtension(): string
        {
            return 'Vérifier l\'extension de l\'image. Les extensions prises en compte sont: jpg, png, webP, jpeg';
        }


        public static function errorImgTypeNotFound(): string
        {
            return 'Impossible d\'ajouter le produit, type de l\'image introuvable';
        }


        public static function errorImgInsertion(): string
        {
            return 'Impossible d\'ajouter le produit. Joignez une image à celle-ci';
        }


        public static function errorFieldEmpty(): string
        {
            return 'Remplissez tous les champs avant de continuer';
        }


        public static function errorProductId(): string
        {
            return 'Entrer l\'identifiant du produit à modifier';
        }


        public static function errorMissingProductId(): string
        {
            return 'Entrer l\'identifiant du produit à acheter';
        }


        public static function errorProductDeletion(): string
        {
            return 'Impossible de supprimer l\'article, mot de passe incorrect';
        }


        public static function errorAdminPassEmpty(): string
        {
            return 'Entrer un mot de passe pour supprimer l\'article';
        }


        public static function errorRightCategory(): string
        {
            return 'Entrez une catégorie correct';
        }


        public static function errorCategoryNotExists(): string
        {
            return 'Entrer une catégorie pour continuer';
        }


        public static function errorMissingProductType(): string
        {
            return 'Entrer le type du produit avant de continuer';
        }
    }