<?php


/**
 * Description of testForm
 *
 * @author kama
 */

require_once 'createForm.php';
class testForm extends createForm {
    //put your code here
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('jakis', 'text', '', 'test', '','');
        $this->addInput('jakis', 'text', '', 'test2', '','');
        $this->addInput('jakisads', 'text', '', 'test3', '','');
        $this->addInput('jakis', 'text', '', 'test', '','');
        //$options[]=array('value'=>'red','text'=>'Red');
        $options[]=array('value'=>'g','text'=>'Green','');
        $options[]=array('value'=>'b','text'=>'Blue','');
          $options[]=array('value'=>'red','text'=>'Red','');
        $this->addSelect('kolory', $options);
        $this->addInput('jakis', 'text', '', 'test', '','');

        echo $this->getHTML();
    }
}
$form=new testForm($_SERVER['PHP_SELF'], 'post');

?>
