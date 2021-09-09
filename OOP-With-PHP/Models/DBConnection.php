<?php

    declare(strict_types=1);

    //Implement DataBase Class
    class DBConnection
    {
        public string $server = "localhost";
        public string $dbName = "group1";
        public string $accountName = "root";
        public string $accountPassword = "";
        public $con;

        public function __Construct()
        {

            $this->con = mysqli_connect($this->server, $this->accountName, $this->accountPassword, $this->dbName);
            if (!$this->con){
                return mysqli_connect_error();
            }
        }

        public function Query($sql)
        {
            $op = mysqli_query($this->con, $sql);
            return $op;
        }

        public function __Destruct()
        {
            $closeConnection = mysqli_close($this->con);
            return $closeConnection;
        }
    }

?>