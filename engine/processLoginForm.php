<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of processLoginForm
 *
 * @author kama
 */
require_once '../lib/auth.php';
require_once '../lib/validator.php';

class processLoginForm {
    //put your code here
    private $login,$pswd,$ident,$error=0,$user;

    public function __construct() {
        $this->validate();
        if(!$this->error) {
            $auth=new auth($this->ident, $this->login, $this->pswd);
            if( $auth->checkIfExist()) $auth->login();
        }
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
$add=new processLoginForm();

?>
