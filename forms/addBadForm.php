<?php


/**
 * Description of dodBadForm
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/createForm.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/mod/modelUser.php';
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/lib/baseConfig.php';
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
        $this->addInput('wyslijbad', 'submit', 'Wyslij', '','','');
    }

    public function display() {
        echo $this->getHTML();
    }
}
$f=new dodBadForm('../mod/modEpr.php', 'post');
$f->display();
?>
