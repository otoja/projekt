
<?php

/**
 * Description of loginForm
 *
 * Klasa tworząca formularz logowania
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/createForm.php';
class loginForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('ident', 'text', '', 'Ident',15,'size=20');
        $this->addInput('login', 'text', '', 'Login',20,'size=20');
        $this->addInput('pswd', 'password', '', 'Hasło',32,'size=20');
        $this->addInput('wyslij', 'submit', 'Zaloguj', '','','');
    }
    public function display(){
        echo $this->getHTML();
    }
}
$log=new loginForm('../e-Przychodnia/engine/processLoginForm.php', 'post');
$log->display();
?>
