<html>
    <head>
        <script type="text/javascript" src="../../scripts/data.js"></script>
    </head>
</html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/auth.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
/**
 * Description of makeVisit
 *
 * @author kama
 */

if (isset($_SESSION['logedin']) && ($_SESSION['logedin']==true)) {
    echo '<p>Rezerwacja wizyty:</p>';
    if (isset($_GET['st'])) $st=$_GET['st'];
    if(isset($_GET['d'])) $d=$_GET['d']+1;
    if (isset($_GET['date'])) $date=$_GET['date'];
    //w dzien tygodnia w aktywnej dacie
    //d wybrany dzien tygodznia
    $w=date("w",strtotime($date));
    if ($w<$d) {
        $d-=$w;
        while ($d>0) {
            $make = strtotime(date("Y-m-d", strtotime($date)) . "  +1 day");
            $date = date("Y-m-d",$make);
            $d--;
        }
        echo $d;
    }else if($w>$d) {
        $w-=$d;
        while ($w>0) {
            $make = strtotime(date("Y-m-d", strtotime($date)) . "  -1 day");
            $date = date("Y-m-d",$make);
            $w--;
        }
    }
    
    $check=date("Y-m-d");
    if ($date<$check) echo 'Nie można zarezerwować wizyty wstecz';
    else {
        if(isset($_GET['id']))$id=$_GET['id'];
        echo 'Proszę potwierdzić rezerwację wizyty:</p>';
        $h=(int)($st/2);
        $m=(int)($st%2*30);
        ($h<10)?$h='0'.$h:$h;
        ($m<10)?$m='0'.$m:$m;
        $msg.='Lekarz :';
        $db=new baseConfig();
        $qry="Select fname, lname FROM osoba as o, lekarz as l WHERE l.id_osoba=o.id_osoba AND l.id_lekarz='$id'";
        $res=$db->getRes($qry);
        $dane=mysql_fetch_assoc($res);
        $msg.=$dane['fname'].' '.$dane['lname'];
        $msg.='<br>Data wizyty: '.$date;
        $msg.='<br>Godzina wizyty: '.$h.':'.$m;

        echo $msg;
        echo '<br><input type="button" value="Potwierdź" onclick="javascript:getData(\'./lib/terminarz/addToCalendar.php?id='.$id.'&st='.$st.'&date='.$date.'&msg='.$msg.'\',\'cont\')"/>';
    }

}
else echo 'Tylko autoryzowani użytkownicy mogą zarezerwować wizyte.';
?>
