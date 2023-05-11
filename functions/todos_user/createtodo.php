<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="functions/todos_user/todo.js"></script>
</head>

<body>
    <div id="todo-cont" class="todo-container">
        <?php
        $connect = mysqli_connect('localhost', 'root', "", "ajax_user_db");

        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
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

        } ?>
    </div>


</body>

</html>