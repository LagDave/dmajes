<?php include "template.php"; ?>
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
            <a href="signup.php">REGISTER</a>
            <a href="index.php"><span>TEST</span></a>
            <a href="admin.php"><span>ADMIN</span></a>
        </div>
    </div>
    <div class="main-container"">
    <form style="box-shadow:0 0 5px rgba(0,0,0,.5);display: flex; background:white; height:300px; flex-direction: column; justify-content: center" method="POST">
        <div class="form-header" style="margin-bottom: auto;background:linear-gradient(45deg,purple, dodgerblue); height:50px;">
            <p class="big-white-text" style="margin:0; height:100%; display: flex; align-items: center; margin-left: 25px">Registration Form</p>
        </div>
        <input required="required" style="margin:5px 20px;font-size: 1em;padding:5px" placeholder="First word of First name" type="text" name="first_name">
        <input required="required" style="margin:5px 20px;font-size: 1em;padding:5px" placeholder="Last Name" type="text" name="last_name">
        <input required="required" style="margin:5px 20px;font-size: 1em;padding:5px" placeholder="Desired 4-Digit Pin" maxlength="4" type="number" name="four_dg_pin">
        <button class="form-button" style="transition:.3s;margin:5px 20px;margin-bottom:auto;background:white; color:dodgerblue; font-weight: bolder; letter-spacing: .5px; font-family: 'Segoe UI'; font-size: 1em;border:2px solid dodgerblue; padding:5px 0px" type="submit" name="submit">Register</button>
    </form>
    <script src="scripts/scripts.js"></script>
    <?php
    if(isset($_POST['submit'])){

        $typed_name = $_POST['first_name'];
        $typed_name = strtolower($typed_name);
        $last_name = $_POST['last_name'];
        $last_name = strtolower($last_name);
        $typed_pin = $_POST['four_dg_pin'];

        $handler = new PDO("mysql:host=localhost;dbname=lagdave", "root", "");
        $sql = "SELECT first_name FROM users";

        $array_of_existing_users = array();
        $does_exist = false;

        $query = $handler->query($sql);
        while($r = $query->fetch()){
            extract($r);
            array_push($array_of_existing_users, $first_name);
        }

        for ($i=0; $i<sizeof($array_of_existing_users); $i++){
            if($typed_name == $array_of_existing_users[$i]){
                $does_exist = true;
                break;
            }else{
                continue;
            }
        }

        if($does_exist == true){
            echo "<div class='error'>","Registered name! Ask admin for PIN</div><br>";
        }else{

            $db_object =  new Database('lagdave', 'root', '');
            $db_object->database_query("INSERT INTO users (first_name,last_name, four_dg_pin) VALUES ('$typed_name','$last_name', '$typed_pin')");

            echo "<div class='error' style='background:dodgerblue'>","Registered! <a href='index.php'><b><u>Answer now.</u></b></a></div><br>";

        }
    }
    ?>
</body>
</html>