<?php

/**
 * Description of wizytaForm
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/createForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/mod/modelUser.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';


class newVisitForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $id=$_POST['pident'];;
        //$this->addInput('ident', 'text', $id, 'Identyfikator pacjenta', '20','DISABLED');

        $this->addTextArea('objawy', '4', '40', '<br>Objawy','');
        $this->addTextArea('doleg', '4', '40', '<br>Dolegliwości','');
        $this->addTextArea('badanie', '8', '40','<br>Opis badania','');
        $this->addInput('rozpoznanie', 'text', '', '<br>Symbol rozpoznania', '4','size=4');
        $widow="onClick=\"javascript:window.open('/Final/forms/addBadForm.php','Wyniki badan','width=700,height=500,toolbar=no,menubar=no')\"";
        $this->addInput("wynbad", "button", "Wyniki badań", "", "", $widow);
        $widow="onClick=\"javascript:window.open('/Final/forms/addReceptaForm.php','Recepta','width=300,height=500')\"";
        $this->addInput("rec", "button", "Recepta", "", "", $widow);
        $widow="onClick=\"javascript:window.open('/Final/forms/addSkierForm.php','Skierowanie','width=300,height=500')\"";
        $this->addInput("skier", "button", "Skierowanie", "", "", $widow);
        $this->addInput('reset', 'reset', 'reset', '<br>','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','');
    }
    public function display() {
        echo $this->getHTML();
    }
}

//$wiz=new newVisitForm('../index.php', 'POST');
//$wiz->display();
?>
