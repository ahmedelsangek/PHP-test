<?php

    require "dbconnection.php";

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    //Delete Image From File
    $selectQuery = "select * from users where id=$id";
    $op = mysqli_query($con, $selectQuery);
    $data = mysqli_fetch_assoc($op);
    unlink($data['image']);

    if (filter_var($id, FILTER_VALIDATE_INT)){
        
        $deleteQuery = "delete from users where id=$id";
        $deleteOp = mysqli_query($con, $deleteQuery);

        if ($deleteOp){
            header("Location: index.php ");
        } else {
            echo "Error happened";
        }

    } else {
        header("Location: index.php ");
    }

    mysqli_close($con);

?>