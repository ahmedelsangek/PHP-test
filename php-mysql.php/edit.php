<?php 


    //session_start();

    require "./dbconnection.php";

    //Get Departments
    $getDepartmentSql = "select * from department";
    $getDepartmenOperation = mysqli_query($con, $getDepartmentSql);

    //Update Data Logic
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if (!filter_var($id, FILTER_VALIDATE_INT)){
        header("Location: index.php");
    }

    $selectQuery = "select * from users where id=$id";

    $op = mysqli_query($con, $selectQuery);

    $data = mysqli_fetch_assoc($op);
    $currentImage = $data['image'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $name = cleanInputs($_POST['name']);
        $email = cleanInputs($_POST['email']);
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

        if (empty($department)){
            $errors['departments'] = "Department Is Requiered";
        }


        if (count($errors) > 0){
            foreach ($errors as $key => $value) {
                echo "*" . $key . " " . "=>" . $value;
            }
        } else {

            if (!empty($_FILES['image']['name'])){
                //Delete Image From File
                unlink($currentImage);
            } else {
                $finalImageName = $currentImage;
            }

            $insertData = "update users set name='$name', email='$email', image='$finalImageName', dept_id=$department where id=$id";
            $op = mysqli_query($con, $insertData);
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
        <form method="POST" action="edit.php?id=<?php echo $data['id'];?>"  enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" value="<?php echo $data['name'];?>" class="form-control" id="name" placeholder="Enter Your Name" name="name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" value="<?php echo $data['email'];?>" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
            <img width="50" height="50" title="profile photo" src="<?php echo $data['image']; ?>" alt="Profle Photo">
            </div>
            <div class="form-group">
                <label for="pro-image">Change profile Image</label>
                <input type="file" id="pro-image" name="image">
            </div>
            <div class="form-group">
                <label for="departments">Choose a Department:</label>
                <select name="departments" id="departments">
                    <?php
                        if (isset($getDepartmenOperation)){
                            while($getDepartmentData = mysqli_fetch_assoc($getDepartmenOperation)){
                    ?>
                        <option value="<?php echo $getDepartmentData['id']; ?>" <?php if ($getDepartmentData['id'] == $data['dept_id']){echo 'selected';}; ?>><?php echo $getDepartmentData['name']; ?></option>
                    <?php }}; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-default">Update</button>
        </form>
        </div>

    </body>
</html>
