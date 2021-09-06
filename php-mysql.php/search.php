<?php

    require "./dbconnection.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $searchInput = cleanInputs($_POST['search']);

        $errors = [];

        if (empty($searchInput)){
            $errors['name'] = "Input Required";
        } else if (!preg_match("/^[a-z ,.'-]+$/i", $searchInput)) {
            $errors['name'] = "Invalid value";
        }

        if (count($errors) > 0){
            foreach($errors as $key => $value){
                echo $key . " " . "=>". " " . $value;
            }
        } else {
            $sqlQuery = "select * from users where name like '%$searchInput%'";
            $sqlOperation = mysqli_query($con, $sqlQuery);

            if (!mysqli_num_rows($sqlOperation) > 0){
                echo "Data Not Found!";
            }
        }

        mysqli_close($con);
    }


    function cleanInputs($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);

        return $input;
    }
?>







<!DOCTYPE html>
<html>
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
    <h1>Display a Search Field</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <label for="search">Search:</label>
  <input type="search" id="search" name="search" require>
  <input type="submit">
</form>


<table class="table" style="margin-top: 100px">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Photo</th>
      </tr>
    </thead>
    <tbody>
        <?php

            if (isset($sqlOperation)){

            while($data = mysqli_fetch_assoc($sqlOperation)){
        ?>

        <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['name']; ?></td>
            <td><?php echo $data['email']; ?></td>
            <td><?php echo $data['password']; ?></td>
            <td><img width="50" height="50" title="profile photo" src="<?php echo $data['image']; ?>" alt="Profle Photo"></td>
        </tr>

        <?php }}?>
    </tbody>
  </table>
    </div>

</body>
</html>