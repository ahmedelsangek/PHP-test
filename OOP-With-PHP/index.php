<?php
    declare(strict_types=1);

    class User
    {
        public string $name;
        public int $age;

        //run when bject created from class
        //it uses ti initialize class's values.
        function __Construct(string $name, int $age){
            $this -> name = $name;
            $this -> age = $age;
        }

        //Setter fucntion
        function setName($value){
            $this -> name = $value;
        }

        //Getter Function
        function getName(){
            return $this -> name;
        }

        function print(){
            echo "My Name Is " . $this -> name . "and Age Is " . $this -> age;
        }

        //it runs in the end of the class
        function __Destruct(){
            echo "Hello From Destructor";
        }
    }

    $obj = new User("Ahmed Magdy", 25);
    $obj -> print();
    // $obj -> setName("Ahmed Magdy");
    // echo $obj -> getName();


?>