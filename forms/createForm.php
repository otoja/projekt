<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/

/**
 * Description of addUserForm
 *
 * @author kama
 */
abstract class createForm {
    //put your code here
    protected $action, $method,$input;
    public function __construct($action,$method) {
        $this->action=$action;
        $this->method=$method;
        }
    public function addInput($name,$type,$value, $text,$max) {
        $this->input[]=array('name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
    }
    public function getHTML() {
        $code= '<form action="'.$this->action.'" method="'.$this->method.'">';
        foreach($this->input as $element) {
            $code .= $element['text'] .' <input name="'.$element['name'] .'" type="'.$element['type']. '" value="'.$element['value'].'"maxlength="'.$element['max'].'"><br />';
        }
        return $code.'</form>';
    }
}
?>
