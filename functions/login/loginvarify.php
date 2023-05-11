<?php
include "../dbConnect.php";
session_start();

if (isset($_POST['submitbtn'])) {
    $password = $_POST["password"];
    $email = $_POST['email'];


    $query = "SELECT * FROM user WHERE email = '$email'";
    $get_user_data = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($get_user_data);
    if (mysqli_num_rows($get_user_data) == 1) {
        $old_password = $row["password"];
        $name = $row['name'];
        $email = $row['email'];
        $gender = $row['gender'];
        $id = $row['id'];
        if (password_verify($password, $old_password)) {
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['gender'] = $gender;
            echo "go to user todos";

        } else {
            echo "Invalid Password";
        }

    } else {
        echo "Invalid user";
    }


} else {
    echo "not ";
}




?>