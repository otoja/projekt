<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of auth
 *
 * @author kama
 */
require_once 'baseConfig.php';
session_start();
class auth {
//put your code here
    
    private $ident,$login,$pswd,$exist=0,$mode;
    private $sAccessDenied = 'Autoryzacja wymagana.';
    private $sRealm = 'Brak dostępu.';

    public function __construct($ident,$login,$pswd) {
        $this->ident=$ident;
        $this->login=$login;
        $this->pswd=$pswd;
        $this->mode=0;
    }

    private function checkDb() {
        $db=new baseConfig();
        $qry="SELECT * FROM osoba WHERE ident='$this->ident' AND mail='$this->login'";
        $res=mysql_fetch_array($db->getRes($qry));
        if ($res) {
            if ($res['haslo']==md5($this->pswd)) {
            }
            $this->exist=1;
        }else $this->exist=0;
    }

    public function checkIfExist() {
        $this->checkDb();
        return $this->exist;
    }

    public function login() {
        if($this->checkIfExist()) {
            $_SESSION['ident']=$this->ident;
            $_SESSION['pswd']=$this->pswd;
            $_SESSION['login']=$this->login;
            $_SESSION['mode']=$this->mode;
            $_SESSION['logedin']=true;
        }
        else $this->failed();
    }

    public function logout() {
        if(isset ($_SESSION['login']))
        session_destroy();
        //header(sprintf('WWW-Authenticate: Basic realm="%s"', $this->sRealm));
        header('HTTP/1.0 401 Unauthorized');
    }
    /**
     * Autoryzacja się nie udała.
     */
    private function failed() {
        header(sprintf('WWW-Authenticate: Basic realm="%s"', $this->sRealm));
        header('HTTP/1.0 401 Unauthorized');
// czekaj 2 sekundy, zabezpieczenie przed brutalforce
        sleep(2);
        die($this->sAccessDenied);
    }
}
?>
