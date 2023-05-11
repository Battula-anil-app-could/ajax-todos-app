<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />
    <link rel="stylesheet" href="function.css" />
    <!-- <script src="../app.js"></script> -->
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

    <div class="main-conti" id='cont'>
        <h1>Welcome to Todos App</h1>
        <form class="reg-form" action="functions/signup.php" method="POST" id="reg-form">
            <div class="cont m-3">
                <label for="fname">Name: </label>
                <input class="name btn" id="fname" name="name" type="text" required />
            </div>
            <div class="cont m-3">
                <label for="emaill">Email: </label>
                <input class="name btn" id="emaill" name="email" type="email" required />
            </div>
            <div class="cont m-3">
                <label for="pass">Password: </label>
                <input class="name btn" id="pass" name="password" type="password" />
            </div>
            <div class="cont m-3">
                <label for="pass2">Conform Password: </label>
                <input class="name btn" id="pass2" name="conform_password" type="password" />
            </div>
            <div class="cont m-3">
                <label for="pass">gender: </label>
                <input class="name btn" id="gender" name="gender" type="radio" value="male" /> male
                <input class="name btn" id="gender" name="gender" type="radio" value="female" /> female
            </div>
            <button class="btn btn-secondary" type="submit" id="submitButton">
                Submit</button>
        </form>
    </div>
    <div id="login"></div>
</body>
<script>

    $('#reg-form').submit((event) => {
        event.preventDefault();
        let name = $("#fname").val();
        let email = $('#emaill').val();
        let password = $('#pass').val();
        let newPassword = $('#pass2').val();
        let gender = $("#gender").val();
        let submitButton = $("#submitButton").val();

        $.ajax({
            url: "functions/signup.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                password: password,
                newPassword: newPassword,
                gender: gender,
                submitButton: submitButton

            },
            success: (res) => {
                console.log(res)
                document.getElementById("fname").value = "";
                document.getElementById("emaill").value = "";
                document.getElementById("pass").value = "";
                document.getElementById("pass2").value = "";
                document.getElementById("gender").value = "";
                if (res === 'insert Success') {
                    $('#cont').load("functions/login/login.php")
                } else if (res === "Email already exist") {
                    alert("Email already exist")
                } else {
                    alert("Password did not match!")
                }
            }
        });
    });


</script>

</html>