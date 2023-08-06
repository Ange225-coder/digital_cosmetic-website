<?php

    declare(strict_types = 1);

    namespace App\model\usersManager;

    use App\model\database\DbManager;

    class UsersManager extends DbManager
    {
        /**
         * this function insert new user in db
         */
        public function setUser(string $full_name, string $email, string $number, string $day, $month, string $year, string $password): bool
        {
            $db = $this->dbConnect();
            $querySetUser = $db->prepare('INSERT INTO users(`u_full-name`, u_email, u_number, u_day, u_month, u_year, u_password, registration_date) VALUES(?, ?, ?, ?, ?, ?, ?, NOW()) ');

            return $querySetUser->execute(array($full_name, $email, $number, $day, $month, $year, $password));
        }

        
        /**
         * this function get user's full name, and it email in db
         * and check for if already exist in it since setUserCtrl
         */
        public function getUserData(): array
        {
            $db = $this->dbConnect();
            $queryGetUserData = $db->prepare('SELECT id, `u_full-name`, u_email FROM users');
            $queryGetUserData->execute();

            return $queryGetUserData->fetchAll();
        }

        /**
         * function which get one user email and
         * check for in the controller with this
         * retrieved email, if the associate pwd is correct
         */
        public function getUserDataForLogin(string $email)
        {
            $db = $this->dbConnect();
            $queryGetUserForLogin = $db->prepare('SELECT * FROM users WHERE u_email = ?');
            $queryGetUserForLogin->execute(array($email));

            return $queryGetUserForLogin->fetch();
        }

        /**
         * function which get orders in process
         * based on a user session
         */
        public function getOrderInProcess(): bool|array
        {
            $db = $this->dbConnect();
            $queryGetOrderInProcess = $db->prepare('SELECT *, DATE_FORMAT(order_date, "%d/%m/%Y à %Hh:%imin:%ss") as orderDate_fr FROM product_order ORDER BY order_date DESC');
            $queryGetOrderInProcess->execute();

            return $queryGetOrderInProcess->fetchAll();
        }

        /**
         * function which get email and check for if it
         * exists in db during pwd modification
         */
        public function getEmail(): array
        {
            $db = $this->dbConnect();
            $queryGetEmail = $db->prepare('SELECT u_email FROM users');
            $queryGetEmail->execute();

            return $queryGetEmail->fetchAll();
        }


        /**
         * reset password about user session
         */
        public function resetPwd(string $password, string $email): bool
        {
            $db = $this->dbConnect();
            $queryResetPwd = $db->prepare('UPDATE users SET u_password = ? WHERE u_email = ?');

            return $queryResetPwd->execute(array($password, $email));
        }

    }