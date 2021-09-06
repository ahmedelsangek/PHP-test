<?php
    session_start();

    echo $_SESSION["email"];





    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $imageName = $_FILES["image"]['name'];
        $imageType = $_FILES["image"]["type"];
        $tempName = $_FILES["image"]["tmp_name"];

        $arrayName = explode('/', $imageType);

        $excetion = end($arrayName);

        $newImageName = rand() . time() . "." . $excetion;

        $allowExcetion = ["png", "jpg", "jpeg"];

        if (in_array($excetion, $allowExcetion)){
            $uploadFolderName = "./upload/";
            $finalImagePath = $uploadFolderName . $newImageName;
            //Transfer File From Temp Folder To Destination Folder
            if(move_uploaded_file($tempName, $finalImagePath)){
                echo "File Uploaded";
            } else {
                echo "Error On Upload, Please Try Again Later";
            }
        } else {
            echo "invalid Image Excetion";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
    <?php require("html-header.php"); ?>
    <body>
        <div class="container">
        <h2>Upload Image</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" id="file" name="image">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        </div>
    </body>
</html>
