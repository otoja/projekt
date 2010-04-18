<?php

/**
 * Description of addPatientForm
 *
 * Klasa tworząca formularz dodawania/edycji pacjenta
 *
 * @author kama
 */
require_once 'addUserForm.php';
class addPatientForm extends addUserForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('ofname', 'text','','Imię opiekuna',20);
        $this->addInput('olname', 'text','','Nazwisko opiekuna',20);
        $this->addInput('opesel', 'text','','Pesel opiekuna',11);
        $this->addInput('krew', 'radio', 'ab', 'AB','');
        $this->addInput('krew', 'radio', 'a', 'A','');
        $this->addInput('krew', 'radio', 'b', 'B','');
        $this->addInput('krew', 'radio', 'z', '0','');
        $this->addInput('rh', 'radio', '-', '-','');
        $this->addInput('rh', 'radio', '+', '+','');
        $this->addInput('plec', 'radio', 'k', 'Kobieta','');
        $this->addInput('plec', 'radio', 'm', 'Mężczyzna','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','');
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
            foreach ($this->input as $key=>$element) {
                if($element['type']=='text')
                    if(!empty($zm[$element['name']])) {
                        $this->input[$key]['value']=stripslashes($zm[$element['name']]);
                    }
            }
        }else echo 'Nie ma takiego użytkownika';
    }
}
?>
