<?php
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
?>
<!doctype html>
<html lang="en">
<head>
    <style>
        body{
            font-family: sans-serif;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p><strong>This Page contains Raw Test Information:</strong><br><i>Reference for Evaluation</i></p>
    <p>Sort Information by:</p>
    <form method="POST">
        <select name="sort">
            <option value="score">Score (BIG TO SMALL)</option>
            <option value="time">Time (OLD TO NEW)</option>
            <option value="name">Name (ALPHABETICAL)</option>
        </select>
        <button type="submit" name="refresh">&#8634;</button>
    </form>
    <hr>
    <div style="overflow-x: auto">
        <table border="1">
            <tr>
                <th>CodeName</th>
                <th>Score</th>
                <th>Average</th>
                <th>Time</th>
            </tr>
            <?php

                $handler = new PDO("mysql:host=localhost;dbname=lagdave", 'root', '');

                if(isset($_POST['refresh'])){
                    $sql;
                    switch ($_POST['sort']){
                        case "score":
                            $sql = "SELECT * FROM quiz ORDER BY score DESC";
                            break;

                        case "time":
                            $sql = "SELECT * FROM quiz ORDER BY time";
                            break;

                        case "name":
                            $sql = "SELECT * FROM quiz ORDER BY codename";
                            break;
                    }

                    $sort = $_POST['sort'];
                    echo "<br>Informations are Sorted according to : <u><b>$sort</b></u></br><br>";
                    $query = $handler->query($sql);
                    while($r = $query->fetch()){
                        extract($r);

                        echo "<tr>";
                            echo "<td>";
                                echo $r['codename'];
                            echo "</td>";
                            echo "<td>";
                                echo $r['score'];
                            echo "</td>";
                            echo "<td>";
                                echo $r['average'];
                            echo "</td>";
                            echo "<td>";
                                echo $r['time'];
                            echo "</td>";
                        echo "</tr>";
                    }

                }

            ?>
        </table>
    </div>
</body>
</html>