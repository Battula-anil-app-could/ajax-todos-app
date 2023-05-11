<?php
$connect = mysqli_connect('localhost', 'root', "", "ajax_user_db");

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $idOfTodo = $_POST["eachId"];

    $isCompleted = "SELECT is_completed FROM todo_table where id = $idOfTodo";
    $chcekIsCompleted = mysqli_query($connect, $isCompleted);
    $status = mysqli_fetch_array($chcekIsCompleted);
    if ($status['is_completed'] === "No") {
        $updatequery = "UPDATE todo_table SET is_completed = 'Yes' WHERE id = $idOfTodo";
        $updateTodo = mysqli_query($connect, $updatequery);
    } else {
        $updatequery = "UPDATE todo_table SET is_completed = 'No' WHERE id = $idOfTodo";
        $updateTodo = mysqli_query($connect, $updatequery);
    }

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

        $isCompleted = "SELECT is_completed FROM todo_table where id = $idOfTodo";
        $chcekIsCompleted = mysqli_query($connect, $isCompleted);
        $status = mysqli_fetch_array($chcekIsCompleted);
        if ($status['is_completed'] === "No") {
            $updatequery = "UPDATE todo_table SET is_completed = 'Yes' WHERE id = $idOfTodo";
            $updateTodo = mysqli_query($connect, $updatequery);
        } else {
            $updatequery = "UPDATE todo_table SET is_completed = 'No' WHERE id = $idOfTodo";
            $updateTodo = mysqli_query($connect, $updatequery);
        }

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