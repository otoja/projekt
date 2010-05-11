<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="./view/styl.css" type="text/css" />
       <script type="text/javascript" src="./scripts/data.js"></script>
        <title>E-przychodnia</title>
    </head>
    <body>
        <div>
            <div id="top">                   
                <div id='login'>
                    <?
                    include $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/loginForm.php';
                    ?>
                </div>
                <div id="top-center">
                    <div id="logo">Tu bedzie jakies logo</div><h1>E-Przychodnia</h1>
                </div>
            </div>
            <div id="center">
                <div id="left">
                    <?
                    include_once $GLOBALS['DOCUMENT_ROOT'].'/Final/engine/side.php';
                    ?>
                </div>
                <div id="cont">
                    <?
//session_start();
                    require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
                    if(isset($_SESSION['login'])) echo 'Witaj, '.$_SESSION['fname'];
                    else echo 'nie jestes zalogowany';
                    ?>
                </div>
            </div>
            <div id="bottom">Created by Kama</div>
        </div>


    </body>
</html>
