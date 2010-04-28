<?php


/**
 * Description of dodBadForm
 *
 * @author kama
 */
include 'createForm.php';
include '../mod/modelUser.php';
require_once '../lib/baseConfig.php';
class dodBadForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $id=$_GET['ident'];   
        $this->addInput('ident', 'text', $id, 'Identyfikator pacjenta', '20','DISABLED');
        $db=new baseConfig();
        $query="Select * FROM badanie";
        $res=$db->getRes($query);
        while($arr=mysql_fetch_array($res)) {
            $this->addInput($arr['nz'], 'text', '', $arr['nz'], '7', 'size=7');
        }
        $this->addInput('reset', 'reset', 'reset', '<br>','','');
        $this->addInput('wyslij', 'submit', 'wyslij', '','','');
    }

    public function display() {
        echo $this->getHTML();
    }
}
$f=new dodBadForm('../engine/processAddBadForm.php', 'post');
$f->display();
?>
