<?php

/**
 * Description of wizytaForm
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/createForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modelUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';


class newVisitForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $id=$_GET['wiz'];
        $db=new baseConfig();
        $qry="SELECT o.fname, o.lname, u.pident, ";
        //$this->addInput('ident', 'text', $id, 'Identyfikator pacjenta', '20','DISABLED');

        $this->addTextArea('objawy', '4', '40', '<br>Objawy','');
        $this->addTextArea('doleg', '4', '40', '<br>Dolegliwości','');
        $this->addTextArea('badanie', '8', '40','<br>Opis badania','');
        $this->addInput('rozpoznanie', 'text', '', '<br>Symbol rozpoznania', '4','size=4');
        $widow="onClick=\"javascript:window.open('/e-Przychodnia/forms/addBadForm.php','Wyniki badan','width=500,height=600,toolbar=no,menubar=no')\" class=button";
        $this->addInput("wynbad", "button", "Wyniki badań", "", "", $widow);
        $widow="onClick=\"javascript:window.open('/e-Przychodnia/forms/addReceptaForm.php','Recepta','width=300,height=500')\" class=button";
        $this->addInput("rec", "button", "Recepta", "", "", $widow);
        $widow="onClick=\"javascript:window.open('/e-Przychodnia/forms/addSkierForm.php','Skierowanie','width=300,height=500')\" class=button";
        $this->addInput("skier", "button", "Skierowanie", "<br>", "", $widow);
        $widow="onClick=\"javascript:window.open('/e-Przychodnia/mod/modEpr.php?type=showEpr','Dotychczasowa historia choroby','width=300,height=500')\" class=button";
        $this->addInput("epr", "button", "Historia choroby", "<br>", "", $widow);
        $this->addInput('reset', 'reset', 'reset', '','','class=button');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','class=button');
    }
    public function display() {
        echo $this->getHTML();
    }
}

//$wiz=new newVisitForm('../index.php', 'POST');
//$wiz->display();
?>
