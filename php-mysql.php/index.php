<?php

    require "checkLogin.php";
    require "./dbconnection.php";

    $selectQuery = "SELECT users.*, department.name as dept_name FROM users LEFT JOIN department on users.dept_id=department.id";
    $op = mysqli_query($con, $selectQuery);

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
  <h2>Users Data</h2>
  <h2><?php echo "Welcome" . " " . $_SESSION['user']['name']; ?></h2>
  <br>
  <a class="btn btn-primary" href="register.php">Add User</a>
  <a class="btn btn-danger" href="logout.php">Log Out</a>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Department</th>
        <th>Photo</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
            while($data = mysqli_fetch_assoc($op)){
        ?>

        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td><?php echo $data['dept_name'];?></td>
            <td><img width="50" height="50" title="profile photo" src="<?php echo $data['image']; ?>" alt="Profle Photo"></td>
            <td><a href="delete.php?id=<?php echo $data['id'];?>" class="btn btn-danger me-2">Delete</a></td>
            <td><a href="edit.php?id=<?php echo $data['id'];?>" class="btn btn-primary">Edit</a></td>
            <td><a href="changePassword.php?id=<?php echo $data['id'];?>" class="btn btn-primary">Change Password</a></td>
        </tr>

        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>