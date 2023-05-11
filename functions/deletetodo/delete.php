<?php
$connect = mysqli_connect('localhost', 'root', "", "ajax_user_db");

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $idOfTodo = $_POST["eachId"];

    $delQuery = "DELETE FROM todo_table WHERE id = $idOfTodo";
    $delTodo = mysqli_query($connect, $delQuery);
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
} else {
    session_start();
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $idOfTodo = $_POST["eachId"];

        $delQuery = "DELETE FROM todo_table WHERE id = $idOfTodo";
        $delTodo = mysqli_query($connect, $delQuery);
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



?>