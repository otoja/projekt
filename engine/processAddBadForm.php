<?php

/**
 * Description of processAddBadForm
 *
 * @author kama
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/validator.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modelUser.php';
class processAddBadForm {
    private $bad=array();
    private $wiz;

    public function __construct() {
        $this->validate();
        $this->addToDb();
    }
    public function validate() {
        $val=new validator();
        $db=new baseConfig();
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (isset($_POST['wiz'])) {
                $this->wiz=$_POST['wiz'];
            }
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
        $query.="'$this->wiz'";
        foreach ($this->bad as $b) {
            $query.=",'".$b['value']."'";
        }
        $query.=",NOW())";
        $db=new baseConfig();
        $db->getRes($query);
        $id_bad=$db->getLastId();
        $qry="SELECT * FROM EPR WHERE id_wizyta=$this->wiz";
        $res=$db->getRes($qry);
        $res=mysql_num_rows($res);
        if ($res==0) {
            $qry="INSERT INTO EPR VALUES('','','$this->wiz','','','',NOW(),'1')";
        }
        else $qry="UPDATE EPR SET id_badanie=1 WHERE id_wizyta=$this->wiz";
        $db->getRes($qry);
    }
}
$f=new processAddBadForm();

?>