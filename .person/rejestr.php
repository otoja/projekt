<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rejestr
 *
 * @author kama
 */
class rejestr extends person{
    public function __construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel) {
        parent::__construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel);
        $this->dane['mode']=3;
    }
}
?>
