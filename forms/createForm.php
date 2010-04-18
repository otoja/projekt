<?php

/**
 * Description of addUserForm
 *
 * Klasa do tworzenia formularzy
 *
 * @author kama
 */
abstract class createForm {
    //put your code here
    protected $action, $method,$input;
    //określenie jaką akcję ma wykonać formularz i jakiej metody użyć
    public function __construct($action,$method) {
        $this->action=$action;
        $this->method=$method;
    }
    //dodanie pola typu input
    public function addInput($name,$type,$value, $text,$max) {
        $this->input[]=array('name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
    }
    //generowanie kodu html
    public function getHTML() {
        $code= '<form action="'.$this->action.'" method="'.$this->method.'">';
        foreach($this->input as $element) {
            $code .= $element['text'] .' <input name="'.$element['name'] .'" type="'.$element['type']. '" value="'.$element['value'].'"maxlength="'.$element['max'].'"><br />';
        }
        return $code.'</form>';
    }
}
?>
