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


    //Use It In Multi Inhertance
    trait Parent2
    {
        public function testClass(){
            echo "Test Class Prent2";
        }
    }



    class SubUser extends User
    {
        use Parent2;


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


    // $obj = new SubUser("ahmed@yahoo.com", "Ahmed Magdy", 25);
    // $obj -> testClass();




    //Access Modifieries------------------------------------
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

    // $bookObj = new Book("CS");
    // // $bookObj -> Set();
    // echo $bookObj -> Get();



    //Validator Class-------------------------
    class Validator
    {
        public $status = true;
        public $input;

        public function __Construct($status)
        {
            $this->status = $status;
        }

        public function checkEmpty($input)
        {
            if (empty($input)){
                return $this->status = false;
            }
        }

        public function checkInt($input)
        {
            if (!filter_var($input, FILTER_SANITIZE_NUMBER_INT) && !filter_var($input, FILTER_VALIDATE_INT)){
                return $this->status = false;
            }
        }

        public function checkEmail($input)
        {
            if (!filter_var($input, FILTER_VALIDATE_Email)){
                return $this->status = false;
            }
        }

        public function checkUrl($input)
        {
            if (!filter_var($input, FILTER_VALIDATE_URL)){
                return $this->status = false;
            }
        }

        public function checkIP($input)
        {
            if (!filter_var($input, FILTER_VALIDATE_IP)){
                return $this->status = false;
            }
        }

        public function checkLength($input, $length)
        {
            if (count($input) < $length){
                return $this->status = false;
            }
        }

        public function checkImageExtension($input)
        {
            $allowExtension = ['jpg', 'png', 'jpeg'];
            if (!in_array($input, $allowExtension)){
                return $this->status = false;
            }
        }
    }


    //Interface Classes------------------------------
    interface Example
    {
        public function SendEmail();
        public function SendPassword();
    }



    class Ex implements Example
    {
        public function SendEmail()
        {
            echo "Send Email";
        }

        public function SendPassword(){}
    }

    // $obj4 = new Ex();
    // $obj4 -> SendEmail();



    //Abstract Class------------------------------
    abstract class Users
    {
        public string $name;
        public string $email;

        public function __Construct(string $name, string $email)
        {
            $this->name = $name;
            $this->email = $email;
        }

        //Static Function => function can class it direct with class name
        public static function PrintMessage()
        {
            echo "Ahmed Magdy";
        }

        abstract function Print();
    }

    //Call Static function
    Users::PrintMessage();


    class UsersChild extends Users
    {
        public function __Construct($name, $email)
        {
            Users::__Construct($name, $email);
        }

        public function Print(){}
    }

    // $obj = new UsersChild("Ahmed Magdy", "Ahmed@yahoo.com");
    // $obj->PrintMessage();
?>