<?php


/**
 * Description of processNewVisitForm
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/validator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modVis.php';
class processNewVisitForm {
    //put your code here
    private $id, $ident, $badanie, $doleg, $objawy, $rozpoznanie, $wiz;

    public function validate() {
        $val=new validator();
        $db=new baseConfig();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['ident']) && !empty($_POST['ident'])) {
                if ($val->isAlnum($_POST['ident'])) $this->ident=$_POST['ident'];
            }if
            (isset($_POST['doleg']) && !empty($_POST['doleg'])) {
                if ($val->isAlnum($_POST['doleg'])) $this->doleg=$_POST['doleg'];
            }if
            (isset($_POST['badanie']) && !empty($_POST['badanie'])) {
                if ($val->isAlnum($_POST['badanie'])) $this->badanie=$_POST['badanie'];
            }if
            (isset($_POST['rozpoznanie']) && !empty($_POST['rozpoznanie'])) {
                if ($val->isAlnum($_POST['rozpoznanie'])) $this->rozpoznanie=$_POST['rozpoznanie'];
            }if
            (isset($_POST['objawy']) && !empty($_POST['objawy'])) {
                if ($val->isAlnum($_POST['objawy'])) $this->objawy=$_POST['objawy'];
            }if
            (isset($_POST['wiz']) && !empty($_POST['wiz'])) {
                if ($val->isAlnum($_POST['wiz'])) $this->wiz=$_POST['wiz'];
            }if
            (isset($_POST['id']) && !empty($_POST['id'])) {
                $this->id=$_POST['id'];
            }
        }
    }

    public function addToDb($wiz) {
        $db=new baseConfig();
        $user=new modelUser();
        $lekarz=$user->getUserData($_SESSION['ident']);
        $id_lekarz=$lekarz['id_lekarz'];
        $this->wiz=$wiz;
        $query="INSERT INTO wizyta VALUES('$this->wiz','$id_lekarz',NOW(),'$this->badanie','$this->doleg','$this->objawy', '$this->rozpoznanie')";
        if($db->getRes($query)) {
            $qry="UPDATE umowione_wizyty SET akt=2 WHERE id_wiz=$this->wiz";
            $db->getRes($qry);
            $qry="SELECT pident FROM umowione_wizyty WHERE id_wiz=$this->wiz";
            $id=$db->getRes($qry);
            $id=mysql_fetch_assoc($id);
            $id=$id['pident'];
            $qry="SELECT * FROM EPR WHERE id_wizyta=$this->wiz";
            $res=$db->getRes($qry);
            $res=mysql_num_rows($res);
            if ($res==0) {
                $qry="INSERT INTO EPR VALUES('','$this->id','$this->wiz','','','',NOW(),'')";
            }else {
                $qry="UPDATE EPR SET id_pacjenta='$this->id' WHERE id_wizyta=$this->wiz";
            }$db
            ->getRes($qry);
        }
        return $db->getLastId();
    }
}
$n=new processNewVisitForm();
$wiz=$_GET['wiz'];
$n->validate();
$n->addToDb($wiz);
header("location: ../index.php")
?>
