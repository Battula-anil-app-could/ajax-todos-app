<?php $connect = mysqli_connect("localhost", "root", "", "ajax_user_db");

if (isset($_POST['submitUpBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['newPassword'];
    $conform_password = $_POST['conformNewPassword'];


    if ($password === $conform_password) {
        if (strlen($password) < 4) {
            echo "<script>const alt = alert('The length of the Password should be above 5 characters')
                        </script>";

        } else {

            $encode_password = password_hash($password, PASSWORD_DEFAULT);
            $select_data = "SELECT * FROM user WHERE email = '$email'";

            $get_select_data = mysqli_query($connect, $select_data);
            $check_data_existing = mysqli_num_rows($get_select_data);

            if ($check_data_existing == 0) {
                echo "Email Error";

            } else {
                $updateQuery = "UPDATE user SET password = '$encode_password' WHERE email = '$email'";
                $runQuery = mysqli_query($connect, $updateQuery);
                echo "updaing Success";
            }

        }




    } else {
        echo "Password did not match!";

    }
}


?>