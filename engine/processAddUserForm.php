<?php

/**
 * Description of processAddUserForm
 *
 * Główna klasa obsługująca formularz z danymi użytkownika, po niej dziedziczą bardziej szczegółowe formularze
 *
 * @author kama
 */


require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/validator.php';
class processAddUserForm {
    protected $query, $fname,$lname,$street,$nr_d,$nr_m, $kod,$city,$country,$tel,$pesel,$nip,$mail,$pswd,$id,$last_id,$error=0;
    //walidacja formularza
    public function validate() {
        $val=new validator();
        try {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                if (isset($_POST['fname']) && !empty($_POST['fname'])) {
                    if ($val->isAlpha($_POST['fname'])) $this->fname=$_POST['fname'];
                }else $val->exc(e_empty);

                if (isset($_POST['lname']) && !empty($_POST['lname'])) {
                    if ($val->isAlpha($_POST['lname'])) $this->lname=$_POST['lname'];
                }else $val->exc(e_empty);

                if (isset($_POST['street']) && !empty($_POST['street'])) {
                    if ($val->isAlpha($_POST['street'])) $this->street=$_POST['street'];
                }else $val->exc(e_empty);

                if (isset($_POST['nr_d']) && !empty($_POST['nr_d']) && isset($_POST['nr_m'])) {
                    if ($val->isAlnum($_POST['nr_d'])) {
                        $this->nr_d=$_POST['nr_d'];
                        if (!empty($_POST['nr_m']) && $val->isAlnum($_POST['nr_m'])) {
                            $this->nr_m=$_POST['nr_m'];
                        }
                    }
                }else $val->exc(e_empty);

                if (isset($_POST['kod']) && !empty($_POST['kod'])) {
                    if($val->isPCode($_POST['kod'])) $this->kod=$_POST['kod'];
                }else $val->exc(e_empty);

                if (isset($_POST['city']) && !empty($_POST['city'])) {
                    if ($val->isAlpha($_POST['city'])) $this->city=$_POST['city'];
                }else $val->exc(e_empty);

                if (isset($_POST['country']) && !empty($_POST['country'])) {
                    if ($val->isAlpha($_POST['country'])) $this->country=$_POST['country'];
                }else $val->exc(e_empty);

                if (isset($_POST['tel']) && !empty($_POST['tel'])) {
                    if($val->isNum($_POST['tel'])) $this->tel=$_POST['tel'];
                }else $val->exc(e_empty);

                if (isset($_POST['pesel']) && !empty($_POST['pesel'])) {
                    if($val->isNum($_POST['pesel'])) $this->pesel=$_POST['pesel'];
                }else $val->exc(e_empty);

                if (isset($_POST['nip']) && !empty($_POST['nip'])) {
                    if($val->isNum($_POST['nip'])) $this->nip=$_POST['nip'];
                }else $val->exc(e_empty);

                if (isset($_POST['mail']) && !empty($_POST['mail'])) {
                    if($val->isEmail($_POST['mail'])) $this->mail=$_POST['mail'];
                }else $val->exc(e_empty);

                if (isset($_POST['pswd']) && !empty($_POST['pswd'])) {
                    if($val->isAlnum($_POST['pswd']) && $val->isAlnum($_POST['rpswd'])) {
                        $ps=$_POST['pswd'];
                        $rps=$_POST['rpswd'];
                        if(md5($ps)===md5($rps)) $this->pswd=md5($ps);
                    }
                }else $val->exc(e_empty);
            }
        }catch(Exception $error) {
            echo '<font color="red">'.$error.'</font><br>';
            $this->error=1;
        }
    }
  //generowanie unikalnego identyfikatora na podstawie imienia, nazwiska, peselu i losowo generowanej liczby
    private function genId() {
        $id=substr($this->fname, 0, 3);
        $id.=substr($this->lname, 0, 3);
        $id.=substr($this->pesel, -3);
        $rand= uniqid (rand (),true);
        $id1=substr($rand, 0,6);
        $this->id=$id.$id1;
    }
    //dodawanie do tab osoba
    public function addToDb() {
        $this->validate();
        if(!$this->error) {
            $this->genId();
            $db=new baseConfig();
            $qr="SELECT COUNT(*) as cnt\n"
                    . "FROM osoba \n"
                    . "WHERE pesel='$this->pesel'";
            try {
                $res=mysql_fetch_array($db->getRes($qr));
                if ($res['cnt']>0) throw new Exception('User already in db');
                else {
                    $query="INSERT INTO osoba VALUES ('','$this->id','$this->fname','$this->lname',\n"
                            . " '$this->street','$this->nr_d','$this->nr_m','$this->city','$this->kod','$this->country','$this->tel','$this->pesel','$this->nip','$this->mail','$this->pswd','','')";
                    $r=$db->getRes($query);
                    $this->last_id=$db->getLastId();
                }
            } catch (Exception $e) {
                echo '<font color="red">'.$e->getMessage().'</font><br>';
                $this->error=1;
            }
        }
    }

}

?>
