<?php

/**
 * Description of processActivevisitForm
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/validator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
$val=new validator();
$wiz=$_GET['wiz'];
$pident=$_GET['id'];
if (isset($_POST['opis'])) {
    if ($val->isAlnum($_POST['opis'])) {
        $opis=$_POST['opis'];
        $qry="UPDATE umowione_wizyty as u SET u.akt=1, u.opis='$opis' WHERE u.id_wiz='$wiz'";
        $db= new baseConfig();
        if($db->getRes($qry)) echo 'Dodano wizytę do oczekujących';
        else echo 'Nastąpił nieoczekiwany błąd.';
    }else $val->exc($error);
}

?>
