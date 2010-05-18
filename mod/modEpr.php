<html>
    <head>
        <script type="text/javascript" src="./../scripts/data.js"></script>
    </head>
</html>
<?php
/**
 * Description of modEpr
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/newVisitForm.php';
//require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/addBadForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/activeVisitForm.php';

class modEpr {
    //put your code here
    private $wiz;
    public function addVisitDesc($wiz) {
        $visit=new newVisitForm('../engine/processNewVisitForm.php?wiz='.$wiz, 'post');
        $visit->display();
    }

    public function addReceipt() {
        $rec=new addReceiptForm('../engine/processAddReceiptForm.php?wiz='.$this->wiz,'post');
    }
    public function setVisitId($id) {
        $this->wiz=$id;
    }
    public function showAllDayVisit($date) {
        $qry="SELECT o.fname, o.lname, l.gab, l.spec, u.data, u.start_stamp, u.pident, u.id_wiz FROM umowione_wizyty as u, osoba as o, lekarz as l WHERE  u.id_lekarz=l.id_lekarz AND l.id_osoba=o.id_osoba ORDER BY u.start_stamp";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        if (mysql_fetch_array($res)) {
            $tab='<table><tr><td>Godzina</td><td>Imię</td><td>Nazwisko</td><td>Gabinet</td><td>Sepcjalizacja</td><td>Pacjent</td><td></td></tr>';
            while ($show=mysql_fetch_array($res)) {
                $h=(int)(($show['start_stamp'])/2);
                $m=(int)(($show['start_stamp'])%2*30);
                ($h<10)?$h='0'.$h:$h;
                ($m<10)?$m='0'.$m:$m;
                $godz=$h.':'.$m;
                $tab.="<tr><td>".$godz."</td><td>".$show['fname']."</td><td>".$show['lname']."</td><td>".$show['gab']."</td><td>".$show['spec']."</td><td>".$show['pident']."</td><td><input type='button' value='Aktywuj' onclick=\"javascript:getData('./mod/modEpr.php?type=act_visit&wiz=".$show['id_wiz']."&id=".$show['pident']."','cont')\"/></td></tr>";
            }
            echo $tab.'</table>';
        }else echo 'Brak wizyt';
    }
    public function showAllDocVisit() {
        $lek=new modelUser();
        $dane=$lek->getUserData($_SESSION['ident']);
        $id=$dane['id_lekarz'];
        $date=date("Y-m-d");
        $qry="SELECT o.fname, o.lname, u.data, u.start_stamp, u.pident FROM umowione_wizyty as u, osoba as o WHERE u.id_lekarz='$id' AND u.pident=o.ident AND u.data>='$date'";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        if (mysql_fetch_array($res)) {
            $tab='<table><tr><td>Data</td><td>Godzina</td><td>Imię</td><td>Nazwisko</td></tr>';
            while ($show=mysql_fetch_array($res)) {
                $h=(int)(($show['start_stamp'])/2);
                $m=(int)(($show['start_stamp'])%2*30);
                ($h<10)?$h='0'.$h:$h;
                ($m<10)?$m='0'.$m:$m;
                $godz=$h.':'.$m;
                $tab.="<tr><td>".$show['data']."</td><td>".$godz."</td><td>".$show['fname']."</td><td>".$show['lname']."</td></tr>";
            }
            echo $tab.'</table>';
        }else echo 'Brak wizyt';
    }
    public function showActiveVisit() {
        $lek=new modelUser();
        $dane=$lek->getUserData($_SESSION['ident']);
        $id=$dane['id_lekarz'];
        $qry="SELECT o.fname, o.lname, u.pident, u.akt, u.start_stamp, u.id_lekarz, u.id_wiz, u.opis FROM osoba as o, umowione_wizyty as u WHERE u.akt=1 AND u.id_lekarz='$id' AND o.ident=u.pident LIMIT 0, 30 ";

        $db=new baseConfig();
        $res=$db->getRes($qry);
        // print_r(mysql_fetch_array($res));
        if($res) {
        $tab='<table><tr><td>Godzina</td><td>Imię</td><td>Nazwisko</td><td>Opis</td><td></td></tr>';
        while ($show=mysql_fetch_array($res)) {
            $h=(int)(($show['start_stamp'])/2);
            $m=(int)(($show['start_stamp'])%2*30);
            ($h<10)?$h='0'.$h:$h;
            ($m<10)?$m='0'.$m:$m;
            $godz=$h.':'.$m;
            $tab.="<tr><td>".$godz."</td><td>".$show['fname']."</td><td>".$show['lname']."</td><td>".$show['opis']."</td><td><input type='button' value='Przeprowadź' onclick=\"javascript:getData('./mod/modEpr.php?type=visit&wiz=".$show['id_wiz']."','cont')\"/></td></tr>";
        }
        echo $tab.'</table>';
        }else echo 'Brak wizyt';
    }

    public function activeVisit($id, $wiz) {
        $act=new activeVisitForm('./engine/processActivevisitForm.php?id='.$id.'&wiz='.$wiz, 'post');
        $act->display();
    }
}


$vis=new modEpr();

if (isset($_GET['type'])) {
    //   if (isset($_SESSION['mode'])) {
    //     if($_SESSION['mode']=='rejestracja' || $_SESSION['mode']=='lekarz') {
//            if (isset($_GET['wiz'])) {
//               
    switch ($_GET['type']) {
        case 'visit':
            $vis->addVisitDesc($_GET['wiz']);
            break;
        case 'bad' :;
            break;
        case 'show_doc': $vis->showAllDocVisit();
            break;
        case 'show':
            $date=date("Y-m-d");
            $vis->showAllDayVisit($date);
            break;
        case 'show_act_visit': $vis->showActiveVisit();
            break;
        case 'act_visit':
        //  if (isset($_GET['wiz']) && isset ($_GET['pident'])) {
            $vis->activeVisit($_GET['id'], $_GET['wiz']);
        // }break;
    }
//            }else echo 'Wskaż wizytę';
//        }else echo 'Nie masz uprawnień do wykonania tej operacji';
    //      }else echo 'Musisz być zalogowany';
    //}
}

?>
