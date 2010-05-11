<?php

/**
 * Description of addPatientForm
 *
 * Klasa tworząca formularz dodawania/edycji pacjenta
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/addUserForm.php';
class addPatientForm extends addUserForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('ofname', 'text','','<br>Imię opiekuna',20,'');
        $this->addInput('olname', 'text','','<br>Nazwisko opiekuna',20,'');
        $this->addInput('opesel', 'text','','<br>Pesel opiekuna',11,'');
        $this->addInput('krew', 'radio', 'ab', '<br>AB','','');
        $this->addInput('krew', 'radio', 'a', 'A','','');
        $this->addInput('krew', 'radio', 'b', 'B','','');
        $this->addInput('krew', 'radio', 'z', '0','','');
        $this->addInput('rh', 'radio', '-', '<br>-','','');
        $this->addInput('rh', 'radio', '+', '+','','');
        $this->addInput('plec', 'radio', 'k', '<br>Kobieta','','');
        $this->addInput('plec', 'radio', 'm', 'Mężczyzna','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '<br>','','');
    }

    public function display() {
        echo $this->getHTML();
    }

    public function editForm($user) {
        parent::editForm($user);
        $db=new baseConfig();
       
        $sql = "SELECT * \n"
                . "FROM pacjent,osoba \n"
                . "WHERE osoba.ident='$user' AND osoba.id_osoba=pacjent.id_osoba";
        $res=$db->getRes($sql);
        
        if ($res) {
            $zm= mysql_fetch_array($res);
            foreach ($this->elements as $key=>$element) {
                if($element['mode']=='input')
                    if(!empty($zm[$element[0]['name']])) {
                        $this->elements[$key][0]['value']=stripslashes($zm[$element[0]['name']]);
                    }
            }
        }else echo 'Nie ma takiego użytkownika';
    }
}
?>
