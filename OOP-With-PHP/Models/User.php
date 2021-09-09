<?php
    declare(strict_types=1);
    // require "./DBConnection.php";


    class User
    {
        public string $name;
        public string $email;
        public string $password;
        public int $dept_id;
        public $db;

        public function __Construct(string $name, string $email, string $password, int $dept_id)
        {
            $this->name = $name;
            $this->email = $email;
            $this->password = md5($password);
            $this->dept_id = $dept_id;

            $this->db = new DBConnection();
        }

        public function Register()
        {
            $sql = "insert into users (name, email, password, dept_id) values('$this->name', '$this->email', '$this->password', $this->dept_id)";
            if ($this->db->Query($sql)) {
                echo "Data Sended";
            }
        }
    }

    // $user1 = new User("Ahmed Magdy", "ahmed@yahoo.com", "A.m0120921406", 1);

    // $user1->Register();

?>