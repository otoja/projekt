<?php

/**
 * Description of addUserForm
 *
 * Klasa przygotowująca formularz dodawania/edycji użytkownika
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/createForm.php';
class addUserForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('fname', 'text', '', 'Imię',20,'');
        $this->addInput('lname','text','','Nazwisko',20,'');
        $this->addInput('street','text','','Ulica',15,'');
        $this->addInput('nr_d','text','','Nr domu',3,'size=1');
        $this->addInput('nr_m','text','','Nr mieszkania',3,'size=1');
        $this->addInput('kod','text','','Kod pocztowy',6,'size=5');
        $this->addInput('city','text','','Miasto',15,'');
        $this->addInput('country','text','','Kraj',20,'');
        $this->addInput('tel','text','','Telefon',11,'');
        $this->addInput('pesel','text','','PESEL',11,'');
        $this->addInput('nip','text','','NIP',12,'');
        $this->addInput('mail','text','','E-mail',20,'');
        $this->addInput('pswd','password','','Hasło',32,'');
        $this->addInput('rpswd','password','','Powtórz hasło',32,'');
    }

    public function editForm($user) {
        $db=new baseConfig();
        //edycja danych użytkownika o podanym identyfikatorze
        $query="SELECT * FROM osoba WHERE ident='$user'";
        $res=$db->getRes($query);
        //funkcja sprawdza czy w bazie, w polach odpowiadających nazwom pól z formularza, znajdują się dane, jeśli tak to wstawia je do formularza.
       
        if ($res) {
            $zm=mysql_fetch_array($res);
            foreach ($this->elements as $key=>$element) {
                if($element['mode']=='input' )
                    if(!empty($zm[$element[0]['name']]) AND ($element[0]['type']!='password')) {
                        var_dump($element[0]['name']);
                        $this->elements[$key][0]['value']=stripslashes($zm[$element[0]['name']]);
                    }
            }
        }else echo 'Nie ma takiego użytkownika';
    }
}
?>
