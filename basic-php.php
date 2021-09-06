<?php
    declare (strict_types = 1);

    // $var1 = "ahmed";
    // $var2 = 25;
    // $var3 = 1.2;

    // echo gettype($var1) . "</br>";
    // echo gettype($var2) . "</br>";
    // echo gettype($var3) . "</br>";

    // echo var_dump($var1) . "</br>";
    // echo var_dump($var2) . "</br>";
    // echo var_dump($var3) . "</br>";


    // $a = 0;
    // do {
    //     $a++;
    //     echo $a . "</br>";
    // } while($a <br 5)

    // for ($i=0; $i <br 5; $i++) { 
    //     if ($i == 3){
    //         break;
    //     } else {
    //         echo $i;
    //     }
    // }
    // for ($i=0; $i <br 5; $i++) { 
    //     if ($i == 3){
    //         continue;
    //     } else {
    //         echo $i;
    //     }
    // }

    // function message(){
    //     return "Ahmed Magdy";
    // }
    // echo message();

    // function sum($num1, $num2=6){
    //     $result = $num1 + $num2;

    //     return $result;
    // } 

    // echo sum(1,2) . "</br>";
    // echo sum(1) . "</br>";



    // function printData(int $age, string $name):string{
    //     return "My Name Is" . " " . $name . " " . "and my Age Is" . " " . $age;
    // }

    // echo printData(25, "Ahmed Magdy");

        //Call by value
    // function sum($num){
    //     return ++$num;
    // }

    // $number = 2;

    // echo sum($number) . "</br>";
    // echo $number;


    //Call by Ref
    // function sum(&$num){
    //     return ++$num;
    // }

    // $number = 2;

    // echo sum($number) . "</br>";
    // echo $number;







    // $age = 20; //global scope

    // echo $age . "</br>";

    // function message(){
    //     global $age;
    //     $name = "ahmed";//local scope
    //     echo $age;
    // }

    // message();

    // echo $name;//undefined because it's variable in local scope belongs to the function.




    // function printNumber(){
    //     static $num = 5;

    //     echo $num;

    //     $num++;
    // }

    // printNumber();
    // echo "</br>";
    // printNumber();



        ////Indexed Array
    // $color = ["Red", "Blue", "Green"];

    // // foreach($color as $value){
    // //     echo $value . "</br>";
    // // }

    // for ($i = 0; $i < count($color); $i++){
    //     echo $color[$i];
    // }




    ////Assosiative Array => if the indexed key as a string
    // $strudentName = ["id" => 2536, "name" => "ahmed Magdy", "grade" => 50];

    // foreach ($strudentName as $key => $value) {
    //     echo $key . " => " . $value . "</br>";
    // }



    // //Multidimensional Array
    // $studentData = array(
    //     array(250, "Ahmed", 50.5),
    //     array(295240, "Magdy"),
    //     array(270, "Kamal", 40.58)
    // );

    // foreach($studentData as $value){

    //     // echo $value[1] . "</br>";


    //     foreach($value as $subValue){
    //         echo $subValue;
    //     }

    //     echo "</br>";
    // }

    


    // echo $_SERVER['PHP_SELF'];
    // echo $_SERVER['SERVER_NAME'];
    // echo $_SERVER['SCRIPT_NAME'];
    // echo $_SERVER['REQUEST_METHOD'];
    // echo $_SERVER[''];


?>
