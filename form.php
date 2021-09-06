<?php 
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        // if ($_POST['name'] == "" || $_POST['email'] == "" || $_POST['password'] == ""){
        //     echo "Your Data Is Empty";
        // }else {
        //     echo "my Name is" . " " . $_POST['name'] . " " . "and my email is". " " . $_POST['email'] . " " . "Password is". "" . $_POST['password'];
        // };

        $name = cleanInputs($_POST['name']);
        $email = cleanInputs($_POST['email']);
        $password = cleanInputs($_POST['password']);

        
        $errors = [];



        if (empty($name)){
            $errors['name'] = "Name Is Requiered";
        } else if (!preg_match("/^[a-z ,.'-]+$/i", $name)) {
            $errors['name'] = "Invalid Name";
        }


        if (empty($email)){
            $errors['email'] = "Email Is Requiered";
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Invalid Email";
        }


        if (empty($password)){
            $errors['password'] = "Password Is Requiered";
        } else if (strlen($password) < 6){
            $errors['password'] = "Password shoud at last 6 character";
        } else {
            $passwordHash =  sha1($password);
        }



        if (count($errors) > 0){
            foreach ($errors as $key => $value) {
                echo "*" . $key . " " . "=>" . $value;
            }
        } else {
            echo "Data Send!";
            //Set Data value in session
            $_SESSION["userData"] = [$name, $email, $passwordHash];
        }


    };

    // $str = "<h1>Root</h1>";
    // $str2 = htmlspecialchars($str);
    // echo $str2;


    // $str = "\ahmed \ tmagdy";
    // echo stripslashes($str);


    function cleanInputs($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }



    // $email = "ahmed2020";

    //  echo filter_var($email, FILTER_SANITIZE_NUMBER_INT);

?>


<!DOCTYPE html>
<html lang="en">
    <?php require("html-header.php"); ?>
    <body>

        <div class="container">
        <h2>Vertical (basic) form</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>

    </body>
</html>
