<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="stylesheets/base.css">
    <style>
        .error{
            background: salmon;
            padding:10px;
            text-align: center;
            font-family: "Segoe UI";
            font-weight: 600;
            color:white;
            transform:translateX(-500px);

            animation:slideRight;
            animation-duration:.3s;
            animation-fill-mode:both;

        }
        .form-header{
            display:flex;
            align-items: center;
        }
        .big-white-text{
            margin:0;
            margin-left: 25px;
        }
        @media(max-width: 500px){
            .error{
                font-size: .9em;
            }
        }

        @keyframes slideRight{
            0%{transform: translateX(-500px)}
            80%{transform: translateX(30px)}
            100%{transform: translateX(0px)}
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin</title>
</head>
<body style="background: linear-gradient(to left ,blue, dodgerblue);">
<header>
    <div class="header-container">
        <span>DMAJMNHS ES1.2</span>
        <span class="hamburger">&#9776;</span>
    </div>
</header>
<div class="nav">
    <div class="nav-container">
        <a href="signup.php"><span>REGISTER</span></a>
        <a href="index.php"><span>TEST</span></a>
        <a href="admin.php"><span>ADMIN</span></a>
    </div>
</div>
    <div class="main-container"">
        <form style="box-shadow:0 0 5px rgba(0,0,0,.5);display: flex; background:white; height:300px; flex-direction: column; justify-content: center" method="POST">
            <div class="form-header" style="margin-bottom: auto;background:linear-gradient(45deg,purple, dodgerblue); height:50px;">
                <p class="big-white-text">Admin</p>
            </div>
            <input style="margin:5px 20px;font-size: 1em;padding:5px" placeholder="Name" type="text" name="admin-name">
            <input style="margin:5px 20px;font-size: 1em;padding:5px" placeholder="Password" type="password" name="password">
            <button class="form-button" style="transition:.3s;margin:5px 20px;margin-bottom:auto;background:white; color:dodgerblue; font-weight: bolder; letter-spacing: .5px; font-family: 'Segoe UI'; font-size: 1em;border:2px solid dodgerblue; padding:5px 0px" type="submit" name="submit">Log In</button>
        </form>
        <?php
        session_start();
        if(isset($_POST['submit'])){
            $real_admin_name = "quiz_admin";
            $real_admin_password = "admin_pass123";

            if($_POST['admin-name'] == $real_admin_name && $_POST['password'] == $real_admin_password){
                echo "Success! you're verified as an admin";
                $_SESSION['an_admin'] = true;
                header("Location: admin-logged.php");
            }else{
                echo "<div class='error'>","You look suspicious!</div><br>";
            }
        }
        ?>
    </div>
<script src="scripts/scripts.js"></script>
</body>
</html>