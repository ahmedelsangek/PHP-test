<?php 


    session_start();
    require "./dbconnection.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){


        $email = cleanInputs($_POST['email']);
        $password = cleanInputs($_POST['password']);

        $errors = [];

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
            $sql = "select * from users where email='$email' and password='$passwordHash'";

            $op = mysqli_query($con, $sql);
            echo mysqli_num_rows($op);

            if (mysqli_num_rows($op) == 1){
                $data = mysqli_fetch_assoc($op);
                $_SESSION['user'] = $data;
                header("Location: index.php");
            } else {
                echo "Invalid email or password";
            }
        }


        mysqli_close($con);
    };

    function cleanInputs($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }

?>


<!DOCTYPE html>
<html lang="en">
    <?php require("../html-header.php"); ?>
    <body>
        <div class="container">
        <h2>Login Form</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
        </div>

    </body>
</html>
