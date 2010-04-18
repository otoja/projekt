<?php

/**
 * Description of processAddEmpForm
 *
 * Klasa obsługująca formularza dodawania pracownika innego niż lekarz
 *
 * @author kama
 */
require_once 'processAddUserForm.php';
class processAddEmpForm extends processAddUserForm {
    protected $date,$stan,$cash;
//walidacja formularza
    public function validate() {
        parent::validate();
        $val=new validator();

        if (isset($_POST['stan']) && !empty($_POST['stan'])) {
            $this->stan=$_POST['stan'];
        }else  $val->exc(e_empty);

        if (isset($_POST['date']) && !empty($_POST['date'])) {
            if ($val->isDate($_POST['date'])) {
                $date=explode('-', $_POST['date']);
                if (checkdate($date[2], $date[0], $date[1]))
                    $this->date=$_POST['date'];
            }else  $val->exc(e_date);
        }else  $val->exc(e_empty);

        if (isset($_POST['cash']) && !empty ($_POST['cash'])) {
            if ($val->isDec($_POST['cash'])) $this->cash=$_POST['cash'];
        } $val

                ->exc(e_empty);
    }
//dodawanie do tab pracownik
    public function addToDb() {
        parent::addToDb();
        $qry="INSERT INTO pracownik VALUES('','','$this->last_id','$this->date','$this->stan','$this->cash')";
        $db=new baseConfig();
        $id=$this->last_id;
        switch($this->stan) {//tworzenie kwerendy w zależności od rodzaju dodawanego użytkownika
            case 'administracja';
                $qry2="UPDATE osoba SET mode=3 WHERE osoba.id_osoba='$id'";
                break;
            case 'admin';
                $qry2="UPDATE osoba SET mode=0 WHERE osoba.id_osoba='$id'";
                break;
            case 'rejestracja';
                $qry2="UPDATE osoba SET mode=4 WHERE osoba.id_osoba='$id'";
                break;
            default:break;
        }
        if(!$this->error){
            $db->getRes($qry);
            $db->getRes($qry2);
        }
    }
}

//$add=new processAddEmpForm();
//$add->addToDb();
?>
