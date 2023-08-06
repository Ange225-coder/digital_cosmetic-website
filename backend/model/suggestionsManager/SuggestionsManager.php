<?php

    declare(strict_types = 1);

    namespace App\model\suggestionsManager;

    use App\model\database\DbManager;

    class SuggestionsManager extends DbManager
    {
        /** this function set new suggestion by user */
        public function setSuggestion(string $full_name, string $email, string $phone_number, string $message): bool
        {
            $db = $this->dbConnect();
            $querySetSuggestion = $db->prepare('INSERT INTO suggestions(s_full_name, s_email, s_phone, s_message, suggestion_date) VALUES(?, ?, ?, ?, NOW()) ');

            return $querySetSuggestion->execute(array($full_name, $email, $phone_number, $message));
        }


        /** this function get all suggestions */
        public function getSuggestions(): bool|array
        {
            $db = $this->dbConnect();
            $queryGetSuggestions = $db->prepare('SELECT *, DATE_FORMAT(suggestion_date, "%d/%m/%Y à %Hh:%imin:%ss") as suggestions_dateFr FROM suggestions ORDER BY suggestion_date DESC');
            $queryGetSuggestions->execute();

            return $queryGetSuggestions->fetchAll();
        }

        /**
         * this function remove a suggestion based on
         * its id
         */
        public function removeSuggestion(string $id): bool
        {
            $db = $this->dbConnect();
            $queryRemoveSuggestion = $db->prepare('DELETE FROM suggestions WHERE id = ?');

            return $queryRemoveSuggestion->execute(array($id));
        }

        /** this function remove all suggestions */
        public function removeAllSuggestions(): bool
        {
            $db = $this->dbConnect();
            $queryRemoveAllSuggestions = $db->prepare('DELETE FROM suggestions');

            return $queryRemoveAllSuggestions->execute();
        }
    }