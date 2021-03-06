<?php


/**
 * Description of addDocForm
 *
 * Klasa tworząca formularz dodawania/edycji lekarza
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/addUserForm.php';

class addDocForm extends addUserForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('spec', 'text', '', 'Specjalizacja',20,'');
        $this->addInput('gab', 'text', '', 'Gabinet',4,'size=2');
        $this->addInput('pozw', 'text', '', 'Pozwolenie',7,'');
        $this->addInput('date', 'text', '', 'Data zatrudnienia',10,'size=10');
        $this->addInput('cash', 'text', '', 'Wynagrodzenie','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','');
    }
    public function display() {
        echo $this->getHTML();
    }
    public function editForm($user) {
        parent::editForm($user);
         $db=new baseConfig();

         //znalezienie lekarza o podanym identyfikatorze
        $sql = "SELECT * \n"
                . "FROM lekarz,osoba \n"
                . "WHERE osoba.ident='$user' AND osoba.id_osoba=lekarz.id_osoba";

        $res=$db->getRes($sql);
        if ($res) {
            //dodawanie danych z bazy do formularza
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
