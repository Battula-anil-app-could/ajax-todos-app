<html>

<head>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <link rel="stylesheet" href="app.css" />
    <!-- <script src="app.js"></script> -->
</head>

<body>
    <div class="header" id="mai-container">
        <p>Welcome To Todos App</p>
        <ul class="links">
            <li>
                <button class="btn btn-primary" onclick="sigin()" id="signin">Sigin</button>
            </li>
            <li>
                <button class="btn btn-secondary" onclick="login()">Login</button>
            </li>
            <li>
                <button class="btn btn-success" onclick="addTask()">Add Task</button>
            </li>
            <li>
                <button class="btn btn-danger" onclick="logOut()">Log Out</button>
            </li>
        </ul>
    </div>
    <div id="registation">
        <?php
        session_start();
        if (isset($_SESSION['id'])) {
            include 'functions/todos_user/todos.php';
        } else {
            include "functions/registation.php";
        }

        ?>
    </div>
</body>

<script>
    let sigin = () => {
        $.ajax({
            url: 'functions/issession.php',
            type: 'GET',
            success: function (res) {
                if (res === "session is active") {
                    $("#signin").hide(1000 * 3)
                    alert('Please Log out')
                    $("#registation").load("functions/todos_user/todos.php")

                } else {
                    $("#signin").show(1000 * 3)
                    $("#registation").load("functions/registation.php")
                }

            },
            err: function (error) {
                console.log(error)
            }
        })

    }
    let login = () => {
        $.ajax({
            url: 'functions/issession.php',
            method: "GET",
            success: (res) => {
                if (res === "session is active") {
                    $("#signin").hide(1000 * 3)
                    $("#registation").load("functions/todos_user/todos.php")

                } else {
                    $("#signin").show(1000 * 3)
                    $("#registation").load("functions/login/login.php")
                }
            }
        });
    }

    let addTask = () => {
        $.ajax({
            url: "functions/issession.php",
            method: "GET",
            success: (res) => {
                if (res === "session is active") {
                    $("#signin").hide(1000 * 3)
                    $("#registation").load("functions/todos_user/todos.php")
                } else {
                    $("#signin").show(1000 * 3)
                    $("#registation").load("functions/login/login.php")
                }
            }
        });
    }

    let logOut = () => {
        $.ajax({
            url: "functions/logout/logout.php",
            method: "GET",
            success: (res) => {
                $("#registation").load("functions/login/login.php")
                $("#signin").show(1000 * 3)
            }
        });
    }
</script>

</html>