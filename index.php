<?php session_start(); include 'template.php'; ?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/base.css">
    <style>
        label{
            cursor: pointer;
        }
        .notif-container{
            height:100%;
            width:100%;
            background:rgba(0,0,0,.7);
            color:white;
            position: fixed;
            bottom:0;
            display: flex;
            align-items: center;
            justify-content: center;

            animation: slideDown;
            animation-duration: .8s;
            animation-fill-mode: both;
        }
        .notif{
            font-family: "Segoe UI", sans-serif;
            font-weight: bolder;
            font-size: 1.2em;
            display:flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background:linear-gradient(45deg,purple, orangered);
            height:50vh;
            width:95%;

            max-height:500px;
            max-width:500px;


        }
        .notif-header{
            display: flex;
            margin-bottom:auto;
            background:white;
            color:black;
            width:100%;
            padding:10px;
            box-sizing: border-box;
        }
        .notif-close{
            cursor: pointer;
        }

        .notif-header p{
            margin: 0;
        }
        .notif-header .notif-close{
            margin-left: auto;
        }
        .notification-text{
            margin-bottom: auto;
        }


        @media(max-width:500px){
            .notif {
                font-size: 1em
            }


        @keyframes fadeIn{
            0%{opacity: 0}
            100%{opacity: 1}
        }
        @keyframes fadeOut{
            0%{opacity: 1}
            100%{opacity: 0}
        }

        @keyframes slideDowns {
            0%{transform: translateY(-1500px)}
            100%{transform:translateY(0px)}
        }
    </style>
    <title>DM Evaluating System 1</title>
</head>
<body>
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

    <div class="main-container">
        <form method="POST" class="main-container">
            <div class="name-container">
                <input type="text" name="codename" placeholder="Name" required="true">
                <input type="number" name="four_dg_pin" placeholder="4-Digit Pin" required="required" maxlength="4">
            </div>

            <?php
                include "administrator_questionaire.php";
            ?>
            <button class="submit_answers" name="submit" type="submit">SUBMIT ANSWERS</button>
        </form>
    </div>
    <!-- If Submit Button is clicked... -->
    <?php include 'processor.php'; ?>
    <script src="scripts/scripts.js"></script>
</body>
</html>