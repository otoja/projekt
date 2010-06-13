<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./view/styl.css" type="text/css" />
        <link rel="shortcut icon" href="./img/ico.jpg" />
        <script type="text/javascript" src="./scripts/data.js"></script>
        <script type="text/javascript" src="./scripts/jquery-1.4.1.js"></script>
        <script type="text/javascript" src="./scripts/nav.js"></script>
        <title>E-przychodnia</title>
    </head>
    <body>
        <div id="content">
            <div id="top" onclick="javascript:location.reload(true)">
            </div>
            <div id="nav" >
                    <?
                    include $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/menu/top.php';
                    ?>            
            </div>
            <div id="center">
                <div id="left" >
                    <?
                    include_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/menu/side.php';
                    ?>
                </div>
                <div id="cont">
                    <?
                    if(isset($_SESSION['login'])) echo 'Witaj, '.$_SESSION['fname'];
                    else echo 'nie jestes zalogowany';
                    ?>
                </div>
                 <div style=" width: 200px; float: left;"></div>
            </div>
            <div id="bottom">Created by Kama</div>
        </div>


    </body>
</html>
