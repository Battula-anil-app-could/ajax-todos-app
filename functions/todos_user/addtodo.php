<?php
include "../dbConnect.php";
session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    if (isset($_POST['addbtn'])) {
        $task = $_POST['task'];
        $check_duplicates_query = "SELECT * from todo_table WHERE userid = $id and task = '$task'";
        $check_duplicates_data = mysqli_query($connect, $check_duplicates_query);

        if (mysqli_num_rows($check_duplicates_data) == 1) {
            echo "This task is already added";
        } else {
            $insert_query_task = "INSERT INTO todo_table (task, userid, is_completed) VALUES ('$task', $id, 'No')";
            $get_insert = mysqli_query($connect, $insert_query_task);
            $take_data_query = "SELECT * FROM todo_table where userid = $id";
            $user_tasks = mysqli_query($connect, $take_data_query);

            $arr = [];
            while ($row = mysqli_fetch_array($user_tasks)) {
                $row['index'] = count($arr);

                array_push($arr, $row);
            }
            if ($arr) {
                echo json_encode($arr);

            }
        }
    }
} else {
    echo "session not active";
}

?>