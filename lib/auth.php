<?php

/**
 * Description of auth
 *
 * logowanie/wylogowywanie/aut
 *
 * @author kama
 */
require_once 'baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modelUser.php';
session_start();
class auth {
//put your code here
   
    private $ident,$login,$pswd,$exist=0,$mode,$fname;
    private $sAccessDenied = 'Autoryzacja wymagana.';
    private $sRealm = 'Brak dostępu.';

    public function __construct($ident,$login,$pswd) {
        $this->ident=$ident;
        $this->login=$login;
        $this->pswd=$pswd;
    }
//sprawdzanie czy użytkownik jest w bazie
    private function checkDb() {
        $db=new baseConfig();
        $user=new modelUser();
        $this->mode=$user->getUserMode($this->ident);
        
        $qry="SELECT * FROM osoba WHERE ident='$this->ident' AND mail='$this->login'";
        $res=mysql_fetch_array($db->getRes($qry));
        if ($res) {
            if ($res['pswd']==md5($this->pswd)){
                 $this->exist=1;
                 $this->fname=$res['fname'];
            }
           
        }else $this->exist=0;
    }

    public function checkIfExist() {
        $this->checkDb();
        return $this->exist;
    }
//funkcja do logowania, ustanawianie zmiennych sesyjnych
    public function login() {
        if($this->checkIfExist()) {
            $_SESSION['ident']=$this->ident;
            $_SESSION['pswd']=$this->pswd;
            $_SESSION['login']=$this->login;
            $_SESSION['fname']=$this->fname;
            $_SESSION['mode']=$this->mode;
            $_SESSION['logedin']=true;
        }
        else $this->failed();
    }
//koniec sesji
    public function logout() {
        if(isset ($_SESSION['login']))
        session_unset();
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
