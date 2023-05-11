<?php include 'dbConnect.php';

if (isset($_POST['submitButton'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conform_password = $_POST['newPassword'];
    $gender = $_POST['gender'];

    if ($password === $conform_password) {
        if (strlen($name) < 2) {
            echo "<script>const alt = alert('The length of the name should be above 2 characters')
                </script>";
        } else {
            if (strlen($email) < 5) {
                echo "<script>const alt = alert('The length of the email should be above 5 characters')
                    </script>";

            } else {
                if (strlen($password) < 4) {
                    echo "<script>const alt = alert('The length of the Password should be above 5 characters')
                        </script>";

                } else {

                    $encode_password = password_hash($password, PASSWORD_DEFAULT);
                    $select_data = "SELECT * FROM user WHERE email = '$email'";

                    $get_select_data = mysqli_query($connect, $select_data);
                    $check_data_existing = mysqli_num_rows($get_select_data);

                    if ($check_data_existing == 0) {
                        $insert_query = "INSERT INTO user (name, email,  gender, password)
                                            VALUES ('$name', '$email', '$gender', '$encode_password')";

                        $insert_data = mysqli_query($connect, $insert_query);

                        echo "insert Success";

                    } else {
                        echo "Email already exist";
                    }

                }

            }

        }
    } else {
        echo "Password did not match!";

    }
}


?>