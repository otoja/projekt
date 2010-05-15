<html>
    <head>
        <script type="text/javascript" src="../../scripts/data.js"></script>
    </head>
</html>
<?php

/**
 * Description of addToCalendar
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/phpmailer/mailConfig.php';
if (isset($_GET['st'])) $st=$_GET['st'];
if (isset($_GET['date'])) $date=$_GET['date'];
if(isset($_GET['id']))$id=$_GET['id'];
if(isset($_GET['msg']))$msg=$_GET['msg'];
$ident=$_SESSION['ident'];
$db= new baseConfig();
$qry="INSERT INTO umowione_wizyty VALUES('','$date','$ident','$id','$st')";
$res=$db->getRes($qry);
if ($res) {
    $user=new modelUser();
    $dane=$user->getUserData($ident);
    $mail=new mailConfig($dane['mail'], 'Potwierdzenie wizyty', $msg);
}
?>
