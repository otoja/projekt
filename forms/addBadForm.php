<?php


/**
 * Description of dodBadForm
 *
 * @author kama
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/forms/createForm.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/mod/modelUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/e-Przychodnia/lib/baseConfig.php';
class addBadForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $id=$_GET['wiz'];
        $this->addInput('wiz', 'hidden', $id, '', '', '');
        $db=new baseConfig();
        $query="Select * FROM badanie";
        $res=$db->getRes($query);
        while($arr=mysql_fetch_array($res)) {
            $this->addInput($arr['nz'], 'text', '', $arr['nz'], '7', 'size=7');
        }
        $this->addInput('reset', 'reset', 'reset', '','','');
        $this->addInput('wyslijbad', 'submit', 'Wyslij', '','','');
    }

    public function display() {
        echo $this->getHTML();
    }
}
$f=new addBadForm('../engine/processAddBadForm.php', 'post');
$f->display();
?>
