<?php

/**
 * Description of loginForm
 *
 * Klasa tworząca formularz logowania
 *
 * @author kama
 */
require_once 'createForm.php';
class loginForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('ident', 'text', '', '<br>Identyfikator',15,'');
        $this->addInput('login', 'text', '', '<br>Login',20,'');
        $this->addInput('pswd', 'password', '', '<br>Hasło',32,'');
        $this->addInput('wyslij', 'submit', '<br>Zaloguj', '','','');
    }
    public function display(){
        echo $this->getHTML();
    }
}
?>
