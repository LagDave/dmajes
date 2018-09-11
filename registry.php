<?php session_start(); ?>
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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="stylesheets/base.css">
    <style>
        /*        Modifiers*/
        .header-container .hamburger{
            margin-left:5px;
        }
        .item_container{
            padding:0;
        }

        body{
            background: linear-gradient(to left ,blue, dodgerblue);
        }
        tr:nth-child(even){
            background: #eee;
        }
        th{
            padding:10px;
        }
        td{
            padding:10px;
        }
        .table_header{
            background:linear-gradient(45deg, purple, dodgerblue);
            color:white;
        }
        .log_out_container{
            display:flex;
            align-items:center;
            justify-content: center;
            margin-left: auto;
        }
        .admin_log_out{
            cursor:pointer;
            padding:3px;
            margin-left: 5px;
            font-family: 'Segoe UI';
            color:white;
            background:salmon;
            font-weight: 600;
            border:2px solid salmon;
            height:100%;
            transition:.3s;
        }
        .admin_log_out:hover{
            color:salmon;
            background:white;
            box-shadow: 0 0 3px rgba(0,0,0,.5);
        }

        /*TABLES*/
        .table_container{
            overflow-x: auto
        }
        .table_container table{
            width:100%; border-collapse: collapse;
        }
        .entry_delete_button{
            cursor:pointer;
            padding:3px;
            margin-left: 5px;
            font-family: 'Segoe UI', sans-serif;
            color:dodgerblue;
            background:transparent;
            font-weight: 600;
            border:2px solid dodgerblue;
            transition:.3s;
        }
        .entry_delete_button:hover{
            color:white;
            background: dodgerblue;
            box-shadow: 0 0 3px rgba(0,0,0,.5);
        }
    </style>
    <title>Document</title>
</head>
<body>

<header>
    <div class="header-container">

        <span>DMAJMNHS ES1.2</span>
        <form class="log_out_container" method="POST">
            <button class="admin_log_out" type="submit" name="log_out">Log Out</button>
        </form>
        <span class="hamburger">&#9776;</span>
    </div>
</header>

<?php
if(isset($_POST['log_out'])){
    session_destroy();
    header("Location: admin.php");
}
?>

<div class="nav">
    <div class="nav-container">
        <a href="index.php"><span>TEST</span></a>
        <a href="admin-logged.php"><span>ADMIN</span></a>
        <a href="registry.php"><span>REGISTRY</span></a>
        <a href="raw_data.php">RAW DATA</a>
    </div>
</div>

<div class="main-container">
    <p class="big-white-text">Registered Users</p>
    <div class="item_container" style="overflow-x: auto">
        <form class="table_container" method="POST">
            <table border="0">
                <tr class="table_header" style="text-align: left; ">
                    <th style="padding-bottom:10px">FName</th>
                    <th style="padding-bottom:10px">LName</th>
                    <th style="padding-bottom:10px">Pin</th>
                    <th style="padding-bottom:10px">Manage</th>

                </tr>
                <?php
                if($_SESSION['an_admin'] == true){

                    $handler = new PDO("mysql:host=localhost;dbname=lagdave", 'root', '');
                    $sql = "SELECT * FROM users";

                    $query = $handler->query($sql);
                    while($r = $query->fetch()){
                        extract($r);

                        echo "<tr>";

                        echo "<td>";
                        echo $first_name;
                        echo "</td>";

                        echo "<td>";
                        echo $last_name;
                        echo "</td>";

                        echo "<td>";
                        echo $four_dg_pin;
                        echo "</td>";

                        echo "<td>";
                        echo "<button class='entry_delete_button' type='submit' name='entry' value='$id'>DELETE</button>";
                        echo "</td>";

                        echo "</tr>";
                    }

                    if(isset($_POST['entry'])){

                        $id = $_POST['entry'];
                        $sql = "DELETE FROM users WHERE id=$id";
                        $query = $handler->query($sql);

                        redirect("registry.php");

                    }
                }else{
                    redirect("admin.php");
                }
                ?>
            </table>
        </form>
    </div>
</div>
<script src="scripts/scripts.js"></script>
</body>
</html>