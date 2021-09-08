<?php
    declare(strict_types=1);

    class User
    {
        public string $name;
        public int $age;

        //run when bject created from class
        //it uses ti initialize class's values.
        public function __Construct(string $name, int $age){
            $this -> name = $name;
            $this -> age = $age;
        }

        //Setter fucntion
        //It unused code in the presence of intilize data in constructor
        public function setName($value){
            $this -> name = $value;
        }

        //Getter Function
        public function getName(){
            return $this -> name;
        }

        public function print(){
            echo "My Name Is " . $this -> name . "and Age Is " . $this -> age;
        }

        //it runs in the end of the class
        // function __Destruct(){
        //     echo "Hello From Destructor";
        // }
    }



    class SubUser extends User
    {
        public string $email;

        public function __Construct(string $email, string $name, int $age)
        {
            $this -> email = $email;
            
            User::__Construct($name, $age);
        }

        //override function
        public function print()
        {
            echo "My Name Is " . $this -> name . "and Age Is " . $this -> age . "and my email is" . $this -> email;
        }
    }



    // $parentObj = new User( "Ahmed Magdy", 25);
    // $childObj = new SubUser( "ahmed@yahoo.com", "Ahmed Magdy", 25);

    // echo $parentObj -> print();
    // echo "<br>";
    // echo $childObj -> print();




    // $obj = new User("Ahmed Magdy", 25);
    // $obj -> print();
    // $obj -> setName("Ahmed Magdy");
    // echo $obj -> getName();




    //Access Modifieries
    class Book
    {
        private string $title;

        public function __Construct(string $title){
            $this->title = $title;
        }

        // public function Set($value){
        //     $this -> title = $value;
        // }

        public function Get(){
            return $this -> title;
        }

    }

    $bookObj = new Book("CS");
    // $bookObj -> Set();
    echo $bookObj -> Get();


?>