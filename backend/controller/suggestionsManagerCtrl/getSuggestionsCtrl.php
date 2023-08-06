<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../../../'.$path);
    });

    use App\model\suggestionsManager\SuggestionsManager;

    function getSuggestionsCtrl(): array
    {
        $getSuggestions = new SuggestionsManager();

        return $getSuggestions->getSuggestions();
    }