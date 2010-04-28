<?php


/**
 * Description of processNewVisitForm
 *
 * @author kama
 */
class processNewVisitForm {
    //put your code here
    private $ident, $badanie, $doleg, $objawy, $rozpoznanie;
    public function __construct() {
    }

    public function validate() {
        $val=new validator();
        $db=new baseConfig();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['ident']) && !empty($_POST['ident'])){
                if ($val->isAlnum($_POST['ident'])) $this->ident=$_POST['ident'];
            }if (isset($_POST['doleg']) && !empty($_POST['doleg'])){
                if ($val->isAlnum($_POST['doleg'])) $this->doleg=$_POST['doleg'];
            }if (isset($_POST['badanie']) && !empty($_POST['badanie'])){
                if ($val->isAlnum($_POST['badanie'])) $this->badanie=$_POST['badanie'];
            }if (isset($_POST['rozpoznanie']) && !empty($_POST['rozpoznanie'])){
                if ($val->isAlnum($_POST['rozpoznanie'])) $this->rozpoznanie=$_POST['rozpoznanie'];
            }if (isset($_POST['objawy']) && !empty($_POST['objawy'])){
                if ($val->isAlnum($_POST['objawy'])) $this->objawy=$_POST['objawy'];
            }
        }
    }

    public function addToDb(){
        $db=new baseConfig();
        $user=new modelUser();
        $lekarz=$user->getUserData($_SESSION['ident']);
        $id=$lekarz['id_lekarz'];
        $query="SELECT INSERT INTO wizyta VALUES('','$id','','$this->badanie','$this->doleg','$this->objawy', '$this->rozpoznanie')";
        $db->getRes($query);
        return $db->getLastId();
    }
}
?>
