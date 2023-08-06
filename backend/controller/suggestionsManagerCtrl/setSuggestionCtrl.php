<?php

    declare(strict_types = 1);

    spl_autoload_register(function($fqcn): void {
        $path = str_replace(['App', '\\'], ['backend', '/'], $fqcn).'.php';
        require_once('../../'.$path);
    });

    use App\model\suggestionsManager\SuggestionsManager;
    use App\exceptions\suggestionsExceptions\SuggestionsManagerExceptions;

    function setSuggestionCtrl(): void
    {
        $setNewSuggestion = new SuggestionsManager();

        $request = $_SERVER['REQUEST_METHOD'];

        if($request == 'POST') {
            $full_name = strip_tags($_POST['full_name']);
            $email = strip_tags($_POST['email']);
            $phone_number = strip_tags($_POST['phone_number']);
            $message = strip_tags($_POST['message']);

            if(preg_match('#^[a-zA-Z ]{4,}$#', $full_name)) {

                if(preg_match('#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $email)) {

                    if(preg_match('#^0[1|5|7]([- ]?[0-9]{2}){4}$#', $phone_number)) {

                        $setNewSuggestion->setSuggestion($full_name, $email, $phone_number, $message);

                        $_SESSION['message'] = 'Message envoyé';
                    }
                    else {
                        throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorPhoneNumberFormat());
                    }
                }
                else {
                    throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorFormatEmail());
                }
            }
            else {
                throw new SuggestionsManagerExceptions(SuggestionsManagerExceptions::errorFormatFullName());
            }
        }
    }