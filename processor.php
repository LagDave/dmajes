<?php

if(isset($_POST['submit'])){
    include "administrator_answerkey.php";

    // A Javascript alternative for header function in PHP
    function redirect($url)
    {
        if (!headers_sent())
        {
            header('Location: '.$url);
            exit;
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'window.location.href="'.$url.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
            echo '</noscript>'; exit;
        }
    }
    // END**END**END

    // Retrieve the typed codename and 4-Digit PIN
    $codename = $_POST['codename'];
    $four_dg_pin = $_POST['four_dg_pin'];

    // Set up a PDO connection to the database
    $handler = new PDO("mysql:host=localhost;dbname=lagdave", "root", "");

    // Query the database to select all from a row with a first_name column is = POST codename
    $sql = "SELECT * FROM users WHERE first_name = '$codename'";
    $query = $handler->query($sql);

    // 1.) If there is something that we could fetch from the DB
    if($result = $query->fetch()){

        // 2.) If the typed 4DG PIN is equals to the database's user 4DG PIN
        if($four_dg_pin == $result['four_dg_pin']){
                $myProcessor = new Processor($answer_key, $codename);
                $_SESSION['result_object'] = $myProcessor;
                redirect("results.php");           
        }
        // 2.) Else if the user typed a wrong password. Show modal
        else{
            echo "<div class=\"notif-container\">
        <div class=\"notif\">
            <div class=\"notif-header\">
                <p>Bummer!</p>
                <p class=\"notif-close\">x</p>
            </div>
            <p class=\"notification-text\">You typed a wrong PIN</p>
        </div>
    </div>";
        }
    } // 1.) If processor cannot find any matching users from the database with the typed one. show modal
    else{
        echo "<div class=\"notif-container\">
        <div class=\"notif\">
            <div class=\"notif-header\">
                <p>Bummer!</p>
                <p class=\"notif-close\">x</p>
            </div>
            <p class=\"notification-text\">We dont recognize your name!</p>
        </div>
    </div>";
    }

} # End** if(isset($_POST[variable]))

