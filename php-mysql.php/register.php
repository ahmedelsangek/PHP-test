<?php 


    //session_start();

    require "./dbconnection.php";

    //Get Departments
    $getDepartmentSql = "select * from department";
    $getDepartmenOperation = mysqli_query($con, $getDepartmentSql);


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = cleanInputs($_POST['name']);
        $email = cleanInputs($_POST['email']);
        $password = cleanInputs($_POST['password']);
        $department = cleanInputs($_POST['departments']);



        //Upload Image functions
        $imageName = $_FILES['image']['name'];
        $imageType = $_FILES['image']['type'];
        $tmpName = $_FILES['image']['tmp_name'];

        $nameArray = explode("/", $imageType);
        $imageExcetion = end($nameArray);
        $newImageName = rand() . time() . "." . $imageExcetion;


        $allowImagesExcetion = ["png", "jpg", "jpeg"];

        if(in_array($imageExcetion, $allowImagesExcetion)){
            $uploadImageFolder = "../upload/";
            $finalImageName = $uploadImageFolder . $newImageName;

            //Transfer File From Temp Folder To Destination Folder
            if (move_uploaded_file($tmpName, $finalImageName)){
                echo "Image Uploaded Done" . "</br>";
            } else {
                echo "Error On Upload, Please Try Again Later";
            }
        } else {
            echo "invalid Image Excetion";
        }






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

        if (empty($department)){
            $errors['departments'] = "Department Is Requiered";
        }

        if (count($errors) > 0){
            foreach ($errors as $key => $value) {
                echo "*" . $key . " " . "=>" . $value;
            }
        } else {
            $insertData = "insert into users (name,email,password, image, dept_id) values ('$name','$email','$passwordHash', '$finalImageName', $department)";

            $op = mysqli_query($con, $insertData);

            if ($op){
                echo "Data Saved";
            } else {
                echo mysqli_error($con);
            }
        }
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
        <h2>Vertical (basic) form</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data">
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
            <div class="form-group">
                <label for="pro-image">Upload profile Image</label>
                <input type="file" id="pro-image" name="image">
            </div>
            <div class="form-group">
                <label for="departments">Choose a Department:</label>
                <select name="departments" id="departments">
                    <?php
                        if (isset($getDepartmenOperation)){
                            while($getDepartmentData = mysqli_fetch_assoc($getDepartmenOperation)){
                    ?>
                        <option value="<?php echo $getDepartmentData['id']; ?>"><?php echo $getDepartmentData['name']; ?></option>
                    <?php }}; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>

    </body>
</html>
