<?php
    include "template.php";
    session_start();
    if(!isset($_SESSION['result_object'])){
        die();
        header("Location: index.php");
    }
    $result_object = $_SESSION['result_object'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/base.css">
    <style>
        body{
            background: linear-gradient(to left ,blue, dodgerblue);
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
    <title>Results</title>
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
            <a href="index.php"><span>TEST</span></a>
            <a href="admin.php"><span>ADMIN</span></a>
        </div>
    </div>
    <div class="main-container">

        <p class="big-white-text">
            <?php echo "Congratulations, $result_object->codename"; ?>
        </p>

        <div class="item_container">

            <p>You got <span class="medium-blue-text"><?php echo $result_object->total_points ?></span> out of <?php echo sizeof($result_object->answer_key) ?> !</p>
            <hr>

<!--        Display Correct Answers    -->
            <p class="medium-green-text">Correct Answers :</p>
            <?php
               for($i=0;$i<sizeof($result_object->correct_answers);$i++){
                    $curr_correct_number = $result_object->correct_numbers[$i]+1;
                    echo "<p class='medium-grey-text'><span>".$curr_correct_number.".) ".$result_object->correct_answers[$i],"</span></p>", '<br>';
                }
            ?>

<!--        Display Wrong Answers -->
            <p class="medium-red-text">Wrong Answers :</p>
            <?php
                for($i=0;$i<sizeof($result_object->wrong_answers);$i++){
                    $curr_wrong_number = $result_object->wrong_numbers[$i]+1;
                    echo "<p class='medium-grey-text'><span>".$curr_wrong_number.".) ".$result_object->wrong_answers[$i],"</span></p>", '<br>';
                }
            ?>

            <?php

        //        Lets Store the Data to the Database for future use!
        //        Instantiate the Database Class
                $db_object =  new Database('lagdave', 'root', '');

                // This is an array of all the users that answered the test
                $users_array = $db_object->database_get("SELECT codename FROM quiz");

                $boolean = false;

                // Evaluate if the user exists in the array
                for($i = 0; $i < sizeof($users_array); $i++){
                    if($result_object->codename === $users_array[$i]['codename']){
                        $boolean = true;
                        break;
                    }else{
                        continue;
                    }
                }
                ?>
        </div>
    </div>
    <?php

        // If it exists, then show the user that he/she is not applicable to answer anymore
        if($boolean === true){
            echo "<div class=\"notif-container\">
                    <div class=\"notif\">
                        <div class=\"notif-header\">
                            <p>Bummer!</p>
                            <p class=\"notif-close\">x</p>
                        </div>
                        <p style=\"text-align: center; padding:5px; box-sizing:border-box\" class=\"notification-text\">You already answered the test. Your score is not recorded. If this is wrong, kindly ask the admin</p>
                    </div>
                </div>";
        }else{
            // else, insert the user and peripherals to the datbase
            // This code inserts the data to the database
            $result_object->codename = strtolower($result_object->codename);
            $db_object->database_query("INSERT INTO quiz (codename, score, average) VALUES ('$result_object->codename', '$result_object->total_points', '$result_object->average')");
        }

    ?>
<script src="scripts/scripts.js"></script>
</body>
</html>
