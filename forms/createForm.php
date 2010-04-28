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
    public function addInput($name,$type,$value, $text,$max,$extra) {
        $this->input=array('name'=>$name,'type'=>$type,'value'=>$value,'text'=> $text,'max'=>$max,'extra'=>$extra);
        $this->addElement('input',$this->input);
    }

    public function addSelect($name, $options,$extra) {
        $this->elements[]=array('mode'=>'select', 'name'=>$name, 'options'=>$options,'extra'=>$extra);
    }

    public function addTextArea($name,$rows,$cols,$text,$extra){
        $this->elements[]=array('mode'=>'textarea','name'=>$name,'rows'=>$rows, 'cols'=>$cols,'text'=>$text,'extra'=>$extra);
    }

    private function addElement($mode,$element) {
        $this->elements[]=array('mode'=>$mode, $element);
    }

    public function getHTML() {
        $code= '<form action="'.$this->action.'" method="'.$this->method.'">';
//        header('Content-Type: text/plain; charset=utf-8');
//        print_r($this->elements);
//        exit;
        foreach ($this->elements as $key=>$input) {
            if($input['mode']=='input') {
                $code .= $this->elements[$key][0]['text'] .' <'.$input['mode'] .' name="'.$this->elements[$key][0]['name'] .'" type="'.$this->elements[$key][0]['type'].'" value="'.$this->elements[$key][0]['value'].'" maxlength="'.$this->elements[$key][0]['max'].'"'.$this->elements[$key][0]['extra'].'>';
            }
            if($input['mode']=='select') {
                $code.=' <'.$input['mode'].' name="'.$input['name'].' '.$input['extra'].'">';
                $opt=$input['options'];
                foreach ($opt as $key=>$option) {
                    $code.='<option value="'.$option['value'].'">'.$option['text'].'</option>';
                }
                $code.= '</select>';
            }
            if ($input['mode']=='textarea'){
                print_r($input);
                $code.=$input['text'].'<'.$input['mode'].' name="'.$input['name'].'" rows="'.$input['rows'].'" cols="'.$input['cols'].'" '.$input['extra'].'></textarea>';
            }
        }
        return $code.'</form>';
    }
}
?>
