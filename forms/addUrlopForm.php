<?php

/**
 * Description of addUrlopForm
 *
 * @author kama
 */
class addUrloForm extends createForm{
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('od', 'text', '', 'Od:', '10', 'size=2');
        $this->addInput('do', 'text', '', 'Do:', '10', 'size=2');
        $this->addInput('wysli', 'submit', 'Zatwierdź', '', '', '');
    }

    public function display(){
        echo $this->getHTML();
    }
}
?>
