<?php

/**
 * Description of urlopForm
 *
 * @author kama
 */
require_once $GLOBALS['DOCUMENT_ROOT'].'/Final/forms/createForm.php';
class workinHsForm extends createForm{
    public function __construct($action, $method) {
        parent::__construct($action, $method);
        $this->addInput('pon_h_s', 'text', '', '<br>Poniedziałek<br>Od:', '2', 'size=1');
        $this->addInput('pon_m_s', 'text', '', ':', '2', 'size=1');
        $this->addInput('pon_h_e', 'text', '', 'Do: ', '2', 'size=1');
        $this->addInput('pon_m_e', 'text', '', ':', '2', 'size=1');
        $this->addInput('wt_h_s', 'text', '', '<br>Wtorek<br>Od:', '2', 'size=1');
        $this->addInput('wt_m_s', 'text', '', ':', '2', 'size=1');
        $this->addInput('wt_h_e', 'text', '', 'Do:', '2', 'size=1');
        $this->addInput('wt_m_e', 'text', '', ':', '2', 'size=1');
        $this->addInput('sr_h_s', 'text', '', '<br>Środa<br>Od:', '2', 'size=1');
        $this->addInput('sr_m_s', 'text', '', ':', '2', 'size=1');
        $this->addInput('sr_h_e', 'text', '', 'Do:', '2', 'size=1');
        $this->addInput('sr_m_e', 'text', '', ':', '2', 'size=1');
        $this->addInput('czw_h_s', 'text', '', '<br>Czwartek<br>Od:', '2', 'size=1');
        $this->addInput('czw_m_s', 'text', '', ':', '2', 'size=1');
        $this->addInput('czw_h_e', 'text', '', 'Do:', '2', 'size=1');
        $this->addInput('czw_m_e', 'text', '', ':', '2', 'size=1');
        $this->addInput('pt_h_s', 'text', '', '<br>Piątek<br>Od:', '2', 'size=1');
        $this->addInput('pt_m_s', 'text', '', ':', '2', 'size=1');
        $this->addInput('pt_h_e', 'text', '', 'Do:', '2', 'size=1');
        $this->addInput('pt_m_e', 'text', '', ':', '2', 'size=1');
        $this->addInput('wyslij', 'submit', 'Uaktualnij', '','','');
    }

    public function dislplay(){
        echo $this->getHTML();
    }
}
$new=new workinHsForm('../engine/processWorkinHsForm.php', 'post');
$new->dislplay();
?>
