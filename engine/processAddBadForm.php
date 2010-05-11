<?php


/**
 * Description of processAddBadForm
 *
 * @author kama
 */

require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/validator.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/mod/modelUser.php';
class processAddBadForm {
    private $bad=array();

    public function __construct() {
//        header('Content-Type: text/plain; charset=utf-8');
//        print_r($_POST);
//        echo "<br><br>";
        $this->validate();
        //$this->addToDb();
    }
    public function validate() {
        $val=new validator();
        $db=new baseConfig();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $query="Select * FROM badanie";

            $res=$db->getRes($query);
            while($arr=mysql_fetch_array($res)) {
                $zm=str_replace(' ','_', $arr['nz']);
                if (isset($_POST[$zm])) {
                    $this->bad[]=array('name'=>$arr['nz'],'value'=>$_POST[$zm]);
                }
            }
        }
    }

    public function addToDb() {
        $query="INSERT INTO lista_badan VALUES('',";
        $user=new modelUser();
        $pacjent=$user->getUserData($_POST['ident']);
        $lekarz=$user->getUserData($_SESSION['ident']);
        $query.="'".$pacjent['id_pacjent']."','".$lekarz['id_lekarz']."'";
        foreach ($this->bad as $b) {
            $query.=",'".$b['value']."'";
        }
        echo count($this->bad);
        $query.=",'');";
        $db=new baseConfig();
        $db->getRes($query);
    }
}
$f=new processAddBadForm();
?>