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
    protected $action, $method,$input,$inp,$elements;
    //określenie jaką akcję ma wykonać formularz i jakiej metody użyć
    public function __construct($action,$method) {
        $this->action=$action;
        $this->method=$method;
    }
    //dodanie pola typu input
    public function addInput($name,$type,$value, $text,$max) {
        //$this->input[]=array('name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
        $this->input=array('name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
        $this->addElement('input',$this->input);
    //    $this->elements[]=array('mode'=>'input', 'name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
    }

    public function addSelect($name, $options){
        $this->elements[]=array('mode'=>'select', 'name'=>$name, 'options'=>$options);
    }
//    public function addElement($element,$type,$value, $text,$max){
//        $this->elements[]=array('element'=>$element,'name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max);
//    }

    private function addElement($mode,$element) {
        $this->elements[]=array('mode'=>$mode, $element);
    }

//generowanie kodu html
//    public function getHTML() {
//        $code= '<form action="'.$this->action.'" method="'.$this->method.'">';
//        foreach($this->input as $element) {
//            $code .= $element['text'] .' <input name="'.$element['name'] .'" type="'.$element['type']. '" value="'.$element['value'].'"maxlength="'.$element['max'].'"><br />';
//        }
//        return $code.'</form>';
//    }

    public function getHTML() {
        $code= '<form action="'.$this->action.'" method="'.$this->method.'">';
        foreach ($this->elements as $key=>$input) {
          
            if($input['mode']=='input')
            $code .= $this->elements[$key][0]['text'] .' <'.$input['mode'] .' name="'.$this->elements[$key][0]['name'] .'" type="'.$this->elements[$key][0]['type']. '" value="'.$this->elements[$key][0]['value'].'"maxlength="'.$this->elements[$key][0]['max'].'"><br />';
           else if($input['mode']=='select')
               $code.=' <'.$input['mode'].' name="'.$input['name'].'>';

           $opt=$input['options'];
               foreach ($opt as $option){
                $code.="\r\n  ".' <option "value"='. $option['value'].'>'.$option['text'].'</option>';
               }
               $code.= '</select></br>';
        }
        return $code;
    }
}
?>
