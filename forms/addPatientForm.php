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
        $options[]=array('value'=>'ab', 'text'=>'AB');
        $options[]=array('value'=>'a', 'text'=>'A');
        $options[]=array('value'=>'b', 'text'=>'B');
        $options[]=array('value'=>'z', 'text'=>'0');
        $this->addSelect('krew', $options, '');
        $opt[]=array('value'=>'-','text'=>'-');
        $opt[]=array('value'=>'+','text'=>'+');
        $this->addSelect('rh', $opt, '');
        $plec[]=array('value'=>'k', 'text'=>'Kobieta');
        $plec[]=array('value'=>'m', 'text'=>'Mężczyzna');
        $this->addSelect('plec', $plec, '');
//        $this->addInput('krew', 'radio', 'ab', '<br>AB','','');
//        $this->addInput('krew', 'radio', 'a', 'A','','');
//        $this->addInput('krew', 'radio', 'b', 'B','','');
//        $this->addInput('krew', 'radio', 'z', '0','','');
//        $this->addInput('rh', 'radio', '-', '<br>-','','');
//        $this->addInput('rh', 'radio', '+', '+','','');
//        $this->addInput('plec', 'radio', 'k', '<br>Kobieta','','');
//        $this->addInput('plec', 'radio', 'm', 'Mężczyzna','','');
         $this->addInput('ofname', 'text','','Imię opiekuna',20,'');
        $this->addInput('olname', 'text','','Nazwisko opiekuna',20,'');
        $this->addInput('opesel', 'text','','Pesel opiekuna',11,'');
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
