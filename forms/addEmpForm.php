<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of addEmpForm
 *
 * @author kama
 */
require_once 'addUserForm.php';
class addEmpForm extends addUserForm {
//put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('stan', 'radio', 'administracja', 'Administracja','');
        $this->addInput('stan', 'radio', 'admin', 'Admin','');
        $this->addInput('stan', 'radio', 'rejestracja', 'Rejestracja','');
        $this->addInput('date', 'text', '', 'Data zatrudnienia',10);
        $this->addInput('cash', 'text', '', 'Wynagrodzenie','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','');
    }

    public function display() {
        echo $this->getHTML();
    }

    public function editForm($user) {
        parent::editForm($user);
        $db=new baseConfig();

        $sql = "SELECT * \n"
                . "FROM pracownik,osoba \n"
                . "WHERE osoba.ident='$user' AND osoba.id_osoba=pracownik.id_osoba";
//wypelnianie formularza danymi odpowiadajacymi nazwom pola input w formularzu
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
