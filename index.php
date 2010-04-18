<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
//session_start();
require_once './lib/auth.php';
if(isset($_SESSION['login'])) echo $_SESSION['login'];
else echo 'nie jestes zalogowany';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $db=new baseConfig();
        ?>
        <a href="./mod/modelUser.php?mode=pacjent">Dodaj pacjenta</a>
        <a href="./forms/addEmpForm.php">Dodaj pracownika</a>
        <a href="./forms/addDocForm.php">Dodaj lekarza</a>
        <a href="./forms/loginForm.php">Zaloguj</a>
        <a href="#">Wyloguj
            <?
            if(isset($_SESSION['ident'])) {
                $auth=new auth($_SESSION['ident'], $_SESSION['login'], $_SESSION['pswd']);
                $auth->logout();
            }
            ?>
        </a>
    </body>
</html>
