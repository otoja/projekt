<?php

/**
 * Description of activeVisitForm
 *
 * @author kama
 */
class activeVisitForm extends createForm {
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        if (isset($_GET['id'])) {
            $user=new modelUser();
            $dane=$user->getUserData($_GET['id']);
            if ($dane['aktyw']==1) {
                $this->addInput('fname', 'text', $dane['fname'], 'Imię pacjenta', '', 'DISABLED');
                $this->addInput('lname', 'text', $dane['lname'], 'Nazwisko', '', 'DISABLED');
                $this->addTextArea('opis', '3', '20', 'opis', '');
                $this->addInput('wyslij', 'submit', 'Aktywuj', '', '', '');
            }else header('Location: ./mod/modelUser.php?mode=edit&act=true','post');
            //else echo 'konto nieaktywne';
        }
    }

    public function display() {
        echo $this->getHTML();
    }
}
?>
