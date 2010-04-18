<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lekarz
 *
 * @author kama
 */
class lekarz extends person{
    public function __construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel, $specjalizacja, $nr_zawodu, $gabinet, $godziny) {
        parent::__construct($fname, $sname, $lname, $street, $fnr, $hnr, $post, $city, $country, $pesel);
        $this->dane['specjalizacja']=$specjalizacja;
        $this->dane['nr_zawodu']=$nr_zawodu;
        $this->dane['gabinet']=$gabinet;
        $this->dane['godziny']=$godziny;
        $this->dane['mode']=2;
    }
}
?>
