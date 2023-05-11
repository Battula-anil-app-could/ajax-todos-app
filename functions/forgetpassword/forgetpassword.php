<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

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
    <div class="main-conti" id="cont">
        <h1>Change Your Password</h1>
        <form class="reg-form" method="POST" action="updatepassword.php" id="update-form">
            <div class="cont m-3">
                <label for="eemail">Enter Email:</label>
                <input name="email" class="name btn" type="email" id="eemail" required />
            </div>
            <div class="cont m-3">
                <label for="pas">Enter New password:</label>
                <input name="password" class="name btn" type="password" id="pas" required />
            </div>
            <div class="cont m-3">
                <label for="pas2">Conform New password:</label>
                <input name="password" class="name btn" type="password" id="pas2" required />
            </div>
            <button type="submit" class="btn btn-success" id="update-btn"> Update</button>
        </form>
</body>
<script>
    $("#update-form").submit((evnet) => {
        evnet.preventDefault();
        let email = $("#eemail").val();
        let newPassword = $("#pas").val();
        let conformNewPassword = $("#pas2").val();
        let submitUpBtn = $("#update-btn").val();
        $.ajax({
            url: "functions/forgetpassword/updatepassword.php",
            method: "POST",
            data: {
                email: email,
                newPassword: newPassword,
                conformNewPassword: conformNewPassword,
                submitUpBtn: submitUpBtn
            },
            success: (res) => {
                if (res === "updaing Success") {
                    $('#cont').load("functions/login/login.php")
                } else if (res === "Email Error") {
                    alert("Email Error")
                } else {
                    alert("Password did not match!")
                }

            }
        })
    })
</script>

</html>