<?php 


    //session_start();

    require "./dbconnection.php";

    //Update Data Logic
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!filter_var($id, FILTER_VALIDATE_INT)){
        header("Location: index.php");
    }



    //Select Data To Get Current Password
    $selectQuery = "select * from users where id=$id";
    $op = mysqli_query($con, $selectQuery);
    $data = mysqli_fetch_assoc($op);



    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $newPassword = cleanInputs($_POST['newpassword']);


        $errors = [];

        if (empty($newPassword)){
            $errors['newpassword'] = "Password Is Requiered";
        } else if (strlen($newPassword) < 6){
            $errors['newpassword'] = "Password shoud at last 6 character";
        } else {
            $newPasswordHash = sha1($newPassword);
        }

        if (count($errors) > 0){
            foreach ($errors as $key => $value) {
                echo "*" . $key . " " . "=>" . $value;
            }
        } else {
            $updatePassword = "update users set password='$newPasswordHash' where id=$id";

            $op = mysqli_query($con, $updatePassword);

            if ($op){
                header("Location: index.php ");
            } else {
                echo "Try Again";
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
        <h2>Edit Your Data</h2>
        <form method="POST" action="changePassword.php?id=<?php echo $data['id'];?>"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="newpwd">New Password</label>
                <input type="password" class="form-control" id="newpwd" placeholder="Enter password" name="newpassword">
            </div>
            <button type="submit" class="btn btn-default">Change</button>
        </form>
        </div>

    </body>
</html>
