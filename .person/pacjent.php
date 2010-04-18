<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pacjent
 *
 * @author kama
 */
class pacjent extends person{
    public function __construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel, $sys_id, $doc, $epr) {
        parent::__construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel);
        $this->dane['sys_id']=$sys_id;
        $this->dane['doc']=$doc;
        $this->dane['epr']=$epr;
    }

}
?>
