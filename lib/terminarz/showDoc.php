<html>
    <head>
        <script type="text/javascript" src="../../scripts/data.js"></script>
    </head>
</html>
<?php

/**
 * Description of showDoc
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/createForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modelUser.php';


$db=new baseConfig();
$qry="SELECT * FROM osoba,lekarz WHERE osoba.id_osoba=lekarz.id_osoba";
$count='SELECT count(*) FROM lekarz';
$count=$db->getRes($count);
$count=mysql_fetch_row($count);
$res=$db->getRes($qry);

echo "<p>Wybierz lekarza, którego terminarz chcesz przejrzeć:</p>
    <br><table id='lekarz'><tr><td>Imię</td><td>Nazwisko</td><td>Specjalizacja</td><td>Gabinet</td><td></td></tr>";
if ($count[0]>1) {
    while ($lek=mysql_fetch_assoc($res)) {
        echo '<tr><td>'.$lek['fname'].'</td><td>'.$lek['lname'].'</td><td>'.$lek['spec'].'</td><td>'.$lek['gab'].'</td><td><input type="button" value="Wybierz" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?id='.$lek['id_lekarz'].'\',\'cont\')"></td></tr>';
    }
    echo '</table>';
}else
    echo '<tr><td>'.$lekarz['fname'].'</td><td>'.$lekarz['lname'].'</td><td>'.$lekarz['spec'].'</td><td>'.$lekarz['gab'].'</td><td><input type="button" value="Wybierz" onclick="javascript:getData(\'./lib/terminarz/showCalendar.php?id='.$lekarz['id_lekarz'].'\',\'cont\')"></td></tr></table>';
?>
