<?php

/**
 * Description of wizytaForm
 *
 * @author kama
 */
include 'createForm.php';
include './mod/modelUser.php';
require_once './lib/baseConfig.php';


class newVisitForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $id=$_GET['ident'];;
        $this->addInput('ident', 'text', $id, 'Identyfikator pacjenta', '20','DISABLED');

        $this->addTextArea('objawy', '4', '40', '<br>Objawy','');
        $this->addTextArea('doleg', '4', '40', '<br>Dolegliwości','');
        $this->addTextArea('badanie', '8', '40','<br>Opis badania','');
        $this->addInput('rozpoznanie', 'text', '', '<br>Symbol rozpoznania', '4','size=4');
        $this->addInput('reset', 'reset', 'reset', '<br>','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','');
    }
    public function display() {
        echo $this->getHTML();
    }
}

$wiz=new wizytaForm('../index.php', 'POST');
$wiz->display();

?>
