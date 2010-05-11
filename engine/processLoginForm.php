<?php

/**
 * Description of processLoginForm
 *
 * Klasa obsługująca formularz logowania
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/auth.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/validator.php';

class processLoginForm {
    //put your code here
    private $login,$pswd,$ident,$error=0,$user;

    public function __construct() {
        $this->validate();
        //if(!$this->error) {
            $auth=new auth($this->ident, $this->login, $this->pswd);
            if( $auth->checkIfExist()){
                $auth->login();

                echo 'correct';
                header('Location: ../index.php');
            }
            else echo 'error';
        //}
    }

    private function validate() {
        $val=new validator();
        try {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                if(isset($_POST['login']) && !empty($_POST['login'])) {
                    if ($val->isEmail($_POST['login'])) $this->login=$_POST['login'];
                }else $val->exc(e_empty);

                if(isset($_POST['ident']) && $_POST['ident']) {
                    if ($val->isAlnum($_POST['ident'])) $this->ident=$_POST['ident'];
                }else $val->exc(e_empty);

                if(isset ($_POST['pswd']) && !empty($_POST['pswd'])) {
                    if ($val->isAlnum($_POST['pswd'])) $this->pswd=$_POST['pswd'];
                }else $val->exc(e_empty);
            }
        }catch(Exception $error) {
            echo '<font color="red">'.$error.'</font><br>';
            $this->error=1;
        }
    }
}
if (isset($_GET['mode']) && $_GET['mode']=='logout' && isset($_SESSION['logedin'])){
    $auth=new auth($_SESSION['ident'], $_SESSION['login'], $_SESSION['pswd']);
    $auth->logout();
    echo 'loggedout';
    header('Location: ../index.php');
}
else  $add=new processLoginForm();

?>
