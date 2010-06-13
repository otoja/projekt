<?php

/**
 * Description of PHPClass
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
class modEpr {
    public function showEprVisit($wiz) {
        $qry="SELECT * FROM wizyta WHERE id_wizyta=$wiz";
        $db=new baseConfig();
        $res=$db->getRes($qry);
        $vis=mysql_fetch_assoc($res);
        $lek=$vis['id_lekarza'];
        $qry="SELECT o.fname, o.lname FROM osoba as o, lekarz as l where o.id_osoba=l.id_osoba AND l.id_lekarz=$lek";
        $lekarz=$db->getRes($qry);
        $lekarz=mysql_fetch_assoc($lekarz);
        echo '<h3>Wizyta</h3>';
        $tab="<table class='epr'>";
        $tab.="<tr><td>Data i godzina</td><td>".$vis['data']."</td></tr>";
        $tab.="<tr><td>Lekarz</td><td>".$lekarz['fname']." ".$lekarz['lname']."</td></tr>";
        $tab.="<tr><td>Zgłaszane dolegliwości</td><td>".$vis['doleg']."</td></tr>";
        $tab.="<tr><td>Dodatkowe objawy</td><td>".$vis['objawy']."</td></tr>";
        $tab.="<tr><td>Opis przeprowadzonej wizyty</td><td>".$vis['badanie']."</td></tr>";
        $tab.="<tr><td>Rozpoznanie</td><td>".$vis['rozpoznanie']."</td></tr></table>";
        echo $tab;
    }
    public function showEprRec($wiz){
        $db=new baseConfig();
        $qry="SELECT * FROM badanie";
        $qry2="SELECT * FROM lista_badan WHERE id_wizyta=$wiz";
        $res=$db->getRes($qry);
        $wyniki=$db->getRes($qry2);
        $wyniki=mysql_fetch_assoc($wyniki);
            $tab='<tr><td>Badanie</td><td>Wynik</td><tr>';
            while($arr=mysql_fetch_array($res)) {
                $zm=str_replace(' ','_', $arr['nz']);

                if (!empty($wyniki[$zm])){
                    $tab.='<tr><td>'.$zm.'</td><td>'.$wyniki[$zm].'</td></tr>';
                }
            }
            echo $tab;
    }
    public function showFullEpr($id) {
        $db=new baseConfig();
        $qry="SELECT * FROM EPR where id_pacjenta=$id";
        $res=$db->getRes($qry);
        //echo '<h3>Wizyta</h3>';
        while($ep=mysql_fetch_assoc($res)) {
            if(!empty($ep['id_wizyta']))
                $this->showEprVisit($ep['id_wizyta']);
            if(!empty($ep['id_badanie'])) {
                echo '<h3>Wyniki badań</h3>';
                echo '<table>';
                $this->showEprRec($ep['id_wizyta']);
                echo '</table>';
            }
            if(!empty($ep['id_recept'])) {
                echo '<h3>Przepisane recepty</h3>';
            }
            if(!empty($ep['id_skierowan'])) {
                echo '<h3>Wystawione skierowania</h3>';
            }
            if(!empty($ep['id_zalecen'])) {
                echo '<h3>Zalecenia</h3>';
            }
        }
    }
}
if(isset($_GET['id'])) {
    $epr=new modEpr();
    $epr->showFullEpr($_GET['id']);
}
?>
