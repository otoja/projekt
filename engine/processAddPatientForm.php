<?php

/**
 * Description of processAddUserForm
 *
 * Klasa obsługująca formularz dodawania pacjenta
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/engine/processAddUserForm.php';
class processAddPatientForm extends processAddUserForm {
    //put your code here
    private $olname,$ofname,$opesel,$plec,$krew;
//walidacja formularza
    public function validate() {
        parent::validate();
        $val=new validator();

        if (isset($_POST['ofname']) && !empty($_POST['ofname'])) {
            if ($val->isAlpha($_POST['ofname'])) $this->ofname=$_POST['ofname'];
        }else $val->exc(e_empty);

        if (isset($_POST['olname']) && !empty($_POST['olname'])) {
            if ($val->isAlpha($_POST['ofname'])) $this->olname=$_POST['olname'];
        }else $val->exc(e_empty);

        if (isset($_POST['opesel']) && !empty($_POST['opesel'])) {
            if($val->isNum($_POST['opesel']))$this->opesel=$_POST['opesel'];
        }else $val->exc(e_empty);

        if (isset($_POST['krew']) && !empty($_POST['krew'])) {
            ($_POST['krew']=='z')?$this->krew='0':$this->krew=$_POST['krew'];
        }else $val->exc(e_empty);

        if (isset($_POST['rh']) && !empty($_POST['rh'])) {
            $this->krew.='Rh'.$_POST['rh'];
        }else $val->exc(e_empty);

        if (isset($_POST['plec']) && !empty($_POST['plec'])) {
            $this->plec=$_POST['plec'];
        }else $val->exc(e_empty);
    }
//dodawanie do tab pacjent
    public function addToDb() {
        parent::addToDb();
        if (isset ($_GET['update'])) $qry="UPDATE pacjent SET ofname='$this->ofname',olname='$this->olname',opesel='$this->opesel',gr_krwi='$this->krew',plec='$this->plec' WHERE id_osoba='$this->last_id'";
        else $qry="INSERT INTO pacjent VALUES('','$this->last_id','$this->ofname','$this->olname','$this->opesel','$this->krew','$this->plec')";
        $id=$this->last_id;
        $qry2="UPDATE osoba SET mode=2 WHERE osoba.id_osoba='$id'";//update roli użytkownika w systemie
        $db=new baseConfig();
        if(!$this->error){
            $db->getRes($qry);
            $db->getRes($qry2);
            echo "Nowy użytkownik został zarejestrowany";
        }
        
    }
}
$u=new processAddPatientForm();
$u->validate();
$u->addToDb();
//header('Location: ../index.php');
?>
