<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <script src="functions/todos_user/todo.js"></script>
</head>
<style>
    .main-conti {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-image: linear-gradient(rgb(244, 244, 67), rgb(156, 163, 209), rgb(244, 188, 223));
        height: 100vh;
        overflow: auto;

    }

    .tasker {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 20px;
        color: green;
        font-weight: bold;
        font-style: italic;
    }

    .name {
        background-color: white;
    }

    .todo-conti {
        margin: 10px;
        padding: 10px;
        background-color: lightsalmon;
        border: 0px solid;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;

    }

    .todo-container {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .each-todo {
        display: flex;
        align-items: center;

    }

    .para {
        font-size: 18px;
    }

    .checkBox {
        width: 20px;
        height: 20px;
    }

    .strikeOn {
        text-decoration: line-through;
    }
</style>

<body>
    <div class="main-conti">

        <?php
        if (isset($_SESSION['id'])) {
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $id = $_SESSION['id'];
        } else {
            session_start();
            if (isset($_SESSION['id'])) {
                $name = $_SESSION['name'];
                $email = $_SESSION['email'];
                $id = $_SESSION['id'];

            } else {
                echo "Please Login";

            }
        }
        ?>
        <h1>
            Hi,
            <?php echo $name ?> add your task.....
        </h1>
        <form method="POST" action="addtodo.php" id="todo-form">
            <label for="task" class="tasker">Add Task</label>
            <input type="text" id="task" name="addTask" class="name btn" />
            <button type="submit" name="add" id="add-btn" class="btn btn-warning">Add Todo</button>
        </form>
        <h1>Your Todos</h1>

        <div id="todo-cont" class="todo-container">
        </div>
    </div>
</body>
<script>

    try {
        let todo_cont = document.getElementById("todo-cont");
        const showTodoLis = (lis, todo_cont) => {
            todo_cont.innerHTML = "";
            for (let i of lis) {
                let eachTodo = document.createElement("div");
                eachTodo.classList.add("todo-conti")
                eachTodo.id = `todo${i.id}`;
                todo_cont.appendChild(eachTodo)

                let CheckBox = document.createElement('input')
                CheckBox.type = "checkbox"
                CheckBox.classList.add("checkBox")
                CheckBox.id = `checkBox${i.id}`
                eachTodo.appendChild(CheckBox)

                let taksOf = document.createElement('p')
                taksOf.classList.add("para");
                taksOf.classList.add("m-3");
                taksOf.textContent = i.task;
                eachTodo.appendChild(taksOf)

                if (i.is_completed === "Yes") {
                    taksOf.classList.add("strikeOn");
                    CheckBox.checked = true
                } else {
                    taksOf.classList.remove("strikeOn");
                    CheckBox.checked = false
                }

                $(CheckBox).click(() => {
                    let checkpara = document.createElement("p")
                    $(checkpara).load("functions/update/update.php", {
                        eachId: i.id
                    }, (res) => {
                        try {
                            let lis = JSON.parse(res)

                            showTodoLis(lis, todo_cont)

                        } catch (err) {
                            console.log(err)
                            lis = []
                            showTodoLis(lis, todo_cont)
                        }
                    })
                })

                let delbtn = document.createElement("button");
                delbtn.type = "submit"
                delbtn.id = i.id;
                delbtn.textContent = "Delete";
                delbtn.classList.add("btn")
                delbtn.classList.add("btn-danger")
                delbtn.classList.add("m-3")
                eachTodo.appendChild(delbtn);

                $(delbtn).click(() => {
                    let para = document.createElement("p")
                    $(para).load("functions/deletetodo/delete.php", {
                        eachId: i.id
                    }, (res) => {
                        try {
                            let lis = JSON.parse(res)
                            if (lis.length > 0) {
                                showTodoLis(lis, todo_cont)
                            }
                        } catch (err) {
                            //console.log(err)
                            lis = []
                            showTodoLis(lis, todo_cont)
                        }

                    })
                })
            }
        }
        const getList = () => {
            //console.log("this is getList fun")
            $.ajax({
                url: "functions/todos_user/showtodo.php",
                method: "GET",
                success: (res) => {
                    try {
                        if (res !== "This task is already added") {
                            let lis = JSON.parse(res)
                            if (lis.length > 0) {
                                showTodoLis(lis, todo_cont)
                            }
                        }
                    } catch (err) {
                        //console.log(err)
                    }
                }
            })
        }

        getList()


        $("#todo-form").submit((event) => {
            event.preventDefault();
            let task = $("#task").val();
            let addbtn = $("#add-btn").val();
            if (task === "") {
                console.log("hi")
            } else {
                $.ajax({
                    url: "functions/todos_user/addtodo.php",
                    method: "POST",
                    data: {
                        task: task,
                        addbtn: addbtn
                    },
                    success: (res) => {
                        if (res !== "This task is already added") {
                            try {
                                let lis = JSON.parse(res)
                                if (lis.length > 0) {
                                    showTodoLis(lis, todo_cont)
                                }
                                document.getElementById('task').value = ""
                            } catch (err) {
                                let lis = []
                                showTodoLis(lis, todo_cont)
                                document.getElementById('task').value = ""
                            }


                        } else {
                            alert("This task is already added")
                        }
                    }
                });
            }
        })
    } catch (err) {
        //console.log(err)
    }

</script>

</html>