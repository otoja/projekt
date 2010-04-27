<?php

/**
 * Description of wizytaForm
 *
 * @author kama
 */
include 'createForm.php';
include './mod/modelUser.php';
require_once './lib/baseConfig.php';


class wizytaForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $user=new modelUser();
        $id=$_GET['ident'];
        $data=$user->getUserData($id);

        $this->addInput('fname', 'text', $data['fname'], 'Imię pacjenta', '20','DISABLED');
        $this->addInput('lname', 'text', $data['lname'], 'Nazwisko pacjenta', '20','DISABLED');
        $this->addInput('pesel', 'text',$data['pesel'], 'Pesel', '11','DISABLED');
        $this->addTextArea('objawy', '4', '40', 'Objawy','');
        $this->addTextArea('doleg', '4', '40', 'Dolegliwości','');
        $this->addTextArea('badanie', '8', '40','Opis badania','');
        $this->addInput('rozp', 'text', '', 'Symbol rozpoznania', '4','size=4');
        // $db=new baseConfig();
        $this->addInput('reset', 'reset', 'reset', '','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','');
        $query="";

    }
    public function display() {
        echo $this->getHTML();
    }
}

$wiz=new wizytaForm('../index.php', 'POST');
$wiz->display();

?>
