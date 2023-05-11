<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <!-- <script src="login.js"></script> -->
    <style>
        .main-conti {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-image: linear-gradient(rgb(244, 244, 67), rgb(156, 163, 209), rgb(244, 188, 223));
            height: 100vh
        }

        .name {
            background-color: white;
        }
    </style>

</head>

<body>
    <div class="main-conti" id="contt">
        <h1>Login Here</h1>
        <form class="reg-form" method="POST" action="loginvarify.php" id="login-form">
            <div class="cont m-3">
                <label for="mail">Enter Email:</label>
                <input name="email" class="name btn" type="email" id="mail" required />
            </div>
            <div class="cont m-3">
                <label for="pass">Enter password:</label>
                <input name="password" class="name btn" type="password" id="pass" required />
            </div>
            <button type="submit" class="btn btn-success" id="submit-btn"> Login</button>
        </form>
        <button class="btn btn-primary ml-auto mr-5" id="forget-btn">Forget Password</button>
</body>
<script>
    $("#forget-btn").click(() => {
        $("#contt").load("functions/forgetpassword/forgetpassword.php")
    })
    $("#login-form").submit((event) => {
        event.preventDefault();
        let email = $("#mail").val();
        let password = $("#pass").val();
        let submitbtn = $("#submit-btn").val();
        //console.log(password)
        $.ajax({
            url: "functions/login/loginvarify.php",
            method: "POST",
            data: {
                email: email,
                password: password,
                submitbtn: submitbtn
            },
            success: (res) => {
                if (res === "go to user todos") {
                    $("#contt").load("functions/todos_user/todos.php")
                } else if (res = "Invalid Password") {
                    alert('Invalid Password or Userid')
                    console.log(res)
                } else {
                    console.log(res)
                    alert('No User Found Please SignUp')
                }
            }
        });
    });
</script>

</html>