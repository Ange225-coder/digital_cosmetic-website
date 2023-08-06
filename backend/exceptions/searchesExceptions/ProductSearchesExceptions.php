<?php

    declare(strict_types = 1);

    namespace App\exceptions\searchesExceptions;

    use RuntimeException;

    class ProductSearchesExceptions extends RuntimeException
    {
        public static function errorMissingKeyword(): string
        {
            return 'Mot clé manquant';
        }
    }