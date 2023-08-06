<?php

    declare(strict_types = 1);

    namespace App\model\adminManager;

    use App\model\database\DbManager;

    class AdminManage extends DbManager
    {
        /**
         * function which get all admins
         * in db
         *
         * this function is used to check if
         * the parameters of new  admin  already exist
         */
        public function getAllAdminParameters(): array
        {
            $db = $this->dbConnect();
            $queryGetAllAdminParameters = $db->prepare('SELECT * FROM admin');
            $queryGetAllAdminParameters->execute();

            return $queryGetAllAdminParameters->fetchAll();
        }

        /**
         * function which insert new admin in
         * db
         */
        public function setAdmin(string $username, string $admin_email, string $password): bool
        {
            $db = $this->dbConnect();
            $querySetNewAdmin = $db->prepare('INSERT INTO admin(a_username, a_email, a_password, a_registration_date) VALUES (?, ?, ?, NOW())');

            return $querySetNewAdmin->execute(array($username, $admin_email, $password));
        }

        /**
         * function which get admin username and check
         * if the pwd associate is right
         *
         * this function is equally used to deletion
         */
        public function getAdminForConnexion(string $auth_name)
        {
            $db = $this->dbConnect();
            $queryGetAdminForConnexion = $db->prepare('SELECT * FROM admin WHERE a_username = ?');
            $queryGetAdminForConnexion->execute(array($auth_name));

            return $queryGetAdminForConnexion->fetch();
        }
    }