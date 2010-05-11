<?php

/**
 * Description of processAddDocForm
 *
 * Klasa obsługująca formularz dodawania lekarza.
 * 
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/engine/processAddUserForm.php';
class processAddDocForm extends processAddUserForm {
    private $pozw, $spec,$godz,$gab,$date,$cash;

    //walidacja danych przy użyciu obiektu klasy validator
    public function validate() {
        parent::validate();
        $val=new validator();

        if (isset($_POST['spec']) && !empty($_POST['spec'])) {
            if ($val->isAlpha($_POST['spec'])) $this->spec=$_POST['spec'];
        }else $val->exc(e_empty);

        if (isset($_POST['gab']) && !empty($_POST['gab'])) {
            if ($val->isAlnum($_POST['gab'])) $this->gab=$_POST['gab'];
        }else $val->exc(e_empty);

        if (isset($_POST['pozw']) && !empty($_POST['pozw'])) {
            if ($val->isPozw($_POST['pozw'])) $this->pozw=$_POST['pozw'];
        }else $val->exc(e_empty);

        if (isset($_POST['date']) && !empty($_POST['date'])) {
            if ($val->isDate($_POST['date'])) {
                $date=explode('-', $_POST['date']);
                if (checkdate($date[2], $date[0], $date[1]))
                    $this->date=$_POST['date'];
            }else  $val->exc(e_date);
        }else $val->exc(e_empty);

        if (isset($_POST['cash']) && !empty ($_POST['cash'])) {
            if ($val->isDec($_POST['cash'])) $this->cash=$_POST['cash'];
        }else $val->exc(e_empty);
    }
//dodanie użytkownika do bazy
    public function addToDb() {
        parent::addToDb();
        $qry="INSERT INTO lekarz VALUES('', '$this->last_id','$this->pozw','$this->gab','$this->spec','$this->date','$this->cash','')";
        $db=new baseConfig();
        $id=$this->last_id;
        $qry2="UPDATE osoba SET mode=1 WHERE osoba.id_osoba='$id'";//aktualizacja roli w systemie
        try {
            if (!$this->error) {
                $db->getRes($qry);
                $db->getRes($qry2);
            }
        }catch (Exception $e) {
            //echo 'dodawanie';
            echo $e->getMessage();
        }
    }
}
$add=new processAddDocForm();
$add->validate();
$add->addToDb();
?>
