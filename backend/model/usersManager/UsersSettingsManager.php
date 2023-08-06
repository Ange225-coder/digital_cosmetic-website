<?php

    declare(strict_types = 1);

    namespace App\model\usersManager;

    use App\model\database\DbManager;

    class UsersSettingsManager extends DbManager
    {
        /**
         * this function do update of user
         * email based on its id
         */
        public function updateEmail(string $email, int $id): bool
        {
            $db = $this->dbConnect();
            $queryUpdateEmail = $db->prepare('UPDATE users SET u_email = ? WHERE id = ?');

            return $queryUpdateEmail->execute(array($email, $id));
        }

        /**
         * this function get user's pwd based on its
         * id
         */
        public function getUserId(int $id)
        {
            $db = $this->dbConnect();
            $queryGetUserId = $db->prepare('SELECT * FROM users WHERE id = ?');
            $queryGetUserId->execute(array($id));

            return $queryGetUserId->fetch();
        }

        /**
         * this function do update of user pwd
         * based on its id
         */
        public function updatePwd(string $password, int $id): bool
        {
            $db = $this->dbConnect();
            $queryUpdateEmail = $db->prepare('UPDATE users SET u_password = ? WHERE id = ?');

            return $queryUpdateEmail->execute(array($password, $id));
        }

        /**
         * this function delete user based
         * on its id
         */
        public function delAccount(int $id): bool
        {
            $db = $this->dbConnect();
            $queryDelAccount = $db->prepare('DELETE FROM users WHERE id = ?');

            return $queryDelAccount->execute(array($id));
        }

        /**
         * this function is used to display user registration date
         * since user settings page
         */
        public function getRegistrationDate(string $email)
        {
            $db = $this->dbConnect();
            $queryGetRegistrationDate = $db->prepare('SELECT registration_date, DATE_FORMAT(registration_date, "%d %M, %Y") as registrationDateFr FROM users WHERE u_email = ?');
            $queryGetRegistrationDate->execute(array($email));

            return $queryGetRegistrationDate->fetch();
        }

    }