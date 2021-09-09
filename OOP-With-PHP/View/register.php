<?php

    require "../Models/DBConnection.php";
    require "../Models/User.php";

    $db = new DBConnection();
    $sql = "select * from department";
    $getDepartmenOperation = $db->Query($sql);



    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $separtment = $_POST['departments'];

        $user1 = new User($name, $email, $password, $separtment);

        $user1->Register();
    }

?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Bootstrap Example</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
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
            <!-- <div class="form-group">
                <label for="pro-image">Upload profile Image</label>
                <input type="file" id="pro-image" name="image">
            </div> -->
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
